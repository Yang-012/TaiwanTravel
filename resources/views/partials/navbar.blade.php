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
                <!-- 已登入：顯示人頭圖框 -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <!-- 後台路徑 -->
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">個人專區</a>
                        </li>
                        <!-- 登出 -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">登出</button>
                            </form>
                        </li>
                    </ul>
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