<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        // 獲取第三方用戶資訊
        $socialUser = Socialite::driver($provider)->user();
        dd($socialUser);//測試API回傳資訊
        // 查找或創建用戶
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail() ?? null],
            ['name' => $socialUser->getName() ?? $socialUser->getNickname()]
        );

        // 更新第三方JSON 欄位
        $socialAccounts = $user->social_accounts ?? []; // 獲取現有的 JSON 陣列
        $socialAccounts[$provider] = $socialUser->getId(); // 添加或更新提供者資訊
        $user->update(['social_accounts' => $socialAccounts]); // 更新欄位

        // 登入用戶
        Auth::login($user, false);

        return redirect('/dashboard');
    }
}
