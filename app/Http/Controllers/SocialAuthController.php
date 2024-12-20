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
        
        //dd($socialUser);//測試API回傳資訊
        
        // 查找用戶，不存在則創建新用戶
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

        // 檢查是否需要顯示網站條款
        if (!$user->has_agreed_terms) {
            return view('dashboard', [
                'showTermsModal' => true,
                'userName' => $user->name ?? '尚未輸入使用者名稱', // 傳遞使用者的名稱，若無則顯示訪客
            ]);
        }
        // 驗證成功，重定向到 Dashboard
        return redirect('/dashboard');
    }
}
