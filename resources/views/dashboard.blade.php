<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- 導覽列 -->
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
    <h1>這是後台</h1>

    <!-- 顯示用戶個人信息 -->
    <div>
        <h2>用戶資訊</h2>
        <p><strong>姓名：</strong> {{ $user->name }}</p>
        <p><strong>Email：</strong> {{ $user->email }}</p>
    </div>

    <!-- 綁定第三方登入資訊 -->
    <div>
        <h2>第三方綁定狀態</h2>

        @if(isset($user->social_accounts['google']))
        <p>已綁定 Google</p>
        @else
        <a href="{{ route('social.login', ['provider' => 'google']) }}">綁定 Google</a>
        @endif

        @if(isset($user->social_accounts['github']))
        <p>已綁定 GitHub</p>
        @else
        <a href="{{ route('social.login', ['provider' => 'github']) }}">綁定 GitHub</a>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>