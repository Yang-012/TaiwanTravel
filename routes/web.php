<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
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
    // 獲取當前登入用戶
    $user = Auth::user();

    // 如果用戶未登入，重定向到登入頁
    if (!$user) {
        return redirect('/login');
    }

    // 輸出視圖，顯示用戶資訊和綁定狀態
    return view('dashboard', [
        'user' => $user
    ]);
})->name('dashboard');


//第三方登入驗證
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('social.login');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

//EMAIL驗證--輸入信箱與使用者名稱
Route::post('/send-verification-code', function (Request $request) {
    $validated = $request->validate([
        'username' => 'required|string|max:255', // 驗證使用者名稱
        'email' => 'required|email',
    ]);

    $user = User::firstOrCreate(
        ['email' => $validated['email']],
        ['name' => $validated['username']] // 使用者名稱儲存到 name 欄位
    );

    $verificationCode = rand(100000, 999999);
    $user->email_verification_code = $verificationCode;
    $user->save();

    Mail::to($user->email)->send(new EmailVerificationMail($verificationCode));

    // 重定向到輸入驗證碼頁面，並附帶 email 作為參數
    return redirect('/verify-code')->with('email', $user->email);
});

//EMAIL驗證--顯示驗證碼輸入畫面
Route::get('/verify-code', function () {
    $email = session('email'); // 從 Session 獲取 email

    if (!$email) {
        return redirect('/'); // 如果 email 不存在，返回首頁
    }

    return view('verify-code', ['email' => $email]);
});

//EMAIL驗證--處理驗證碼驗證
Route::post('/verify-code', function (Request $request) {
    // 驗證輸入數據
    $validated = $request->validate([
        'email' => 'required|email',
        'code' => 'required|digits:6',
    ]);

    // 查找用戶並檢查驗證碼
    $user = User::where('email', $validated['email'])
                ->where('email_verification_code', $validated['code'])
                ->first();

    if (!$user) {
        return back()->withErrors(['code' => '驗證碼無效或已過期']);
    }

    // 驗證成功，清除驗證碼並標記為已驗證
    $user->email_verified_at = now();
    $user->email_verification_code = null;
    $user->save();

    return redirect('/dashboard')->with('success', '驗證成功，您的電子郵件已完成驗證！');
});