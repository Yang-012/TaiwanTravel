<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- 導覽列 開始 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- 登出按鈕 -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary">登出</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 導覽列 結束 -->

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

    <!-- blade判定初次登入顯示網站條款 開始 -->
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
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ url('/') }}'">不同意</button>
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
    <!-- blade判定初次登入顯示網站條款 開始 -->

</body>


</html>