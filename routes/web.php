<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use App\Services\TwilioService;
use App\Models\User;


// 預設首頁
Route::get('/', function () {
    return view('welcome');
});

// 登入頁面
Route::get('/login', function () {
    return view('login');
})->name('login');



//登出頁面
Route::middleware(['auth'])->group(function () {  //使用auth中介，確保登入者才能進入該route
    Route::post('/logout', function () {
        Auth::logout();         //清除認證狀態
        session()->flush();     //清除session
        return redirect('/');
    })->name('logout');
});

// 後台頁面
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) {
        return redirect('/login')->with('error', 'You must be logged in to access the dashboard.');
    }
    return view('dashboard', [
        'user' => $user
    ]);
})->name('dashboard');

//初次登入顯示網站條款
Route::post('/agree-terms', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login')->with('error', '請先登入。');
    }

    $user->has_agreed_terms = true;
    $user->save();

    return redirect('/dashboard')->with('success', '您已同意條款，歡迎使用！');
});


//第三方登入驗證
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('social.login');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

// EMAIL與簡訊驗證--發送驗證碼到 Email 和手機
Route::post('/send-verification-code', function (Request $request, TwilioService $twilioService) {
    // 驗證請求數據
    $validated = $request->validate([
        'type' => 'required|string|in:email,sms', // 必須是 email 或 sms
        'username' => 'required|string|max:255', // 驗證使用者名稱
        'email' => 'nullable|email',             // 如果是 Email，則必須是有效的 Email 格式
        'phone' => 'nullable|string|max:15',     // 如果是 SMS，則必須是有效的手機號碼
    ]);

    // 根據請求類型處理
    if ($validated['type'] === 'email') {
        // Email 驗證邏輯
        if (!$validated['email']) {
            return response()->json(['error' => 'Email is required for email verification.'], 422);
        }

        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['username']]
        );

        $emailVerificationCode = rand(100000, 999999);
        $user->email_verification_code = $emailVerificationCode;
        $user->save();

        Mail::to($user->email)->send(new EmailVerificationMail($emailVerificationCode));

        // 成功後重定向到輸入驗證碼頁面，並附帶 email
        return redirect('/verify-code')->with('email', $user->email);
    } elseif ($validated['type'] === 'sms') {
        // SMS 驗證邏輯
        if (!$validated['phone']) {
            return response()->json(['error' => 'Phone is required for SMS verification.'], 422);
        }

        // 格式化台灣號碼為國際格式
        $phone = $validated['phone'];
        if (preg_match('/^09\d{8}$/', $phone)) {
            $formattedPhone = '+886' . substr($phone, 1); // 移除首位 0，並加上 +886
        } elseif (preg_match('/^\+886\d{9}$/', $phone)) {
            $formattedPhone = $phone; // 已經是正確的國際格式，直接使用
        } else {
            return response()->json(['error' => 'Invalid phone number format.'], 422);
        }

        $user = User::firstOrCreate(
            ['phone' => $formattedPhone],
            ['name' => $validated['username']]
        );

        $smsVerificationCode = rand(100000, 999999);
        $user->phone_verification_code = $smsVerificationCode;
        $user->save();

        $twilioService->sendSMS($formattedPhone, "你的手機驗證碼為: $smsVerificationCode");

        // 成功後重定向到輸入驗證碼頁面，並附帶 phone
        return redirect('/verify-code')->with('phone', $formattedPhone);
    }

    return response()->json(['error' => 'Invalid verification type.'], 422);
});


//EMAIL與簡訊驗證--顯示驗證碼輸入畫面
Route::get('/verify-code', function () {
    $email = session('email');
    $phone = session('phone');

    if (!$email && !$phone) {
        return redirect('/'); // 如果 email 和 phone 均不存在，返回首頁
    }

    return view('verify-code', ['email' => $email, 'phone' => $phone]);
});

//EMAIL與簡訊驗證--處理驗證碼驗證
Route::post('/verify-code', function (Request $request) {
    // 驗證請求數據
    $validated = $request->validate([
        'type' => 'required|string|in:email,sms', // 必須是 email 或 sms
        'email' => 'nullable|email',             // 如果是 Email，則必須是有效的 Email 格式
        'phone' => 'nullable|string|max:15',     // 如果是 SMS，則必須是有效的手機號碼
        'code' => 'required|digits:6',           // 驗證碼
    ]);

    if ($validated['type'] === 'email') {
        // Email 驗證邏輯
        if (!$validated['email']) {
            return response()->json(['error' => 'Email is required for email verification.'], 422);
        }

        $user = User::where('email', $validated['email'])
            ->where('email_verification_code', $validated['code'])
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid email verification code.'], 422);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->save();
        Auth::login($user); // 自動登入

        // 檢查是否需要顯示網站條款
        if (!$user->has_agreed_terms) {
            return view('dashboard', [
                'showTermsModal' => true,
                'userName' => $user->name ?? '訪客', // 傳遞使用者的名稱，若無則顯示訪客
            ]);
        }

        // 驗證成功，重定向到 Dashboard
        return redirect('/dashboard')->with('success', 'Email verification successful.');
    } elseif ($validated['type'] === 'sms') {
        // SMS 驗證邏輯
        if (!$validated['phone']) {
            return response()->json(['error' => 'Phone is required for SMS verification.'], 422);
        }

        $user = User::where('phone', $validated['phone'])
            ->where('phone_verification_code', $validated['code'])
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid SMS verification code.'], 422);
        }

        $user->phone_verified_at = now();
        $user->phone_verification_code = null;
        $user->save();
        Auth::login($user); // 自動登入

        // 檢查是否需要顯示網站條款
        if (!$user->has_agreed_terms) {
            return view('dashboard', [
                'showTermsModal' => true,
                'userName' => $user->name ?? '訪客', // 傳遞使用者的名稱，若無則顯示訪客
            ]);
        }
        // 驗證成功，重定向到 Dashboard
        return redirect('/dashboard')->with('success', 'SMS verification successful.');
    }

    return back()->withErrors(['error' => 'Invalid verification type.']);
});
