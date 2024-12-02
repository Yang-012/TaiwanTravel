<!-- 導覽列 開始-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">TravelHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                <!-- 已登入：顯示登出按鈕 -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">登出</button>
                    </form>
                </li>
                @else
                <!-- 未登入：顯示登入按鈕 -->
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{ route('login') }}">登入</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- 導覽列 結束-->