<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialAuthController;


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


