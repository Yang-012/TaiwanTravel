@extends('layouts.app')

@section('content')
<h1>這是後台</h1>

<!-- 顯示用戶個人信息 開始 -->
@if(isset($user))
<div>
    <h2>用戶資訊</h2>
    <p><strong>姓名：</strong> {{ $user->name }}</p>
    <p><strong>Email：</strong> {{ $user->email }}</p>
    <p><strong>Phone：</strong> {{ $user->phone }}</p>
</div>
@else
<p>用戶資料無法顯示。</p>
@endif
<!-- 顯示用戶個人信息 開始 -->

<!-- 綁定第三方登入資訊 開始-->
<div>
    <h2>第三方綁定狀態</h2>

    @if(isset($user->social_accounts['google']))
    <p>已綁定 Google</p>
    @else
    <a href="{{ route('social.login', ['provider' => 'google']) }}">綁定 Google</a>
    @endif

    @if(isset($user->social_accounts['line']))
    <p>已綁定 LINE</p>
    @else
    <a href="{{ route('social.login', ['provider' => 'line']) }}">綁定 LINE</a>
    @endif

    @if(isset($user->social_accounts['twitter']))
    <p>已綁定 LINE</p>
    @else
    <a href="{{ route('social.login', ['provider' => 'twitter']) }}">綁定 TWITTER</a>
    @endif
</div>
<!-- 綁定第三方登入資訊 結束-->

<!-- 判定是否初次登入顯示條款 開始 -->
@if(isset($showTermsModal) && $showTermsModal)
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">網站條款與隱私政策</h5>
            </div>
            <div class="modal-body">
                <p>歡迎來到TaiwanTravel：</p>
                <p><strong>{{ $userName }}</strong> 為第一次登入，請閱讀並同意以下條款：</p>
                <ul>
                    <li>條款 1：您同意遵守所有相關規定。</li>
                    <li>條款 2：網站數據僅用於合法用途。</li>
                    <li>條款 3：我們保護您的個人隱私。</li>
                </ul>
                <p>點擊「我同意」以繼續使用。</p>
            </div>
            <div class="modal-footer">
                <form action="/agree-terms" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">我同意</button>
                </form>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary">不同意並登出</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
        termsModal.show();
    });
</script>
@endif
<!-- 判定是否初次登入顯示條款 結束 -->
@endsection