<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- 導覽列 開始-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">My Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- 登入 按鈕 -->
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}">登入</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 導覽列 結束-->

    <!-- 登入頁面 開始 -->
    <section class="bg-primary py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-bg-primary">
                        <div class="col-12 col-xl-9">
                            <hr class="border-primary-subtle mb-4">
                            <h2 class="h1 mb-4">TaiwanTravel</h2>
                            <p class="lead mb-5">這是登入頁面</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h2 class="h3">登入</h2>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="/send-verification-code">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Your Username" required>
                                    <label for="username" class="form-label">使用者名稱</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="name@example.com" required>
                                    <label for="email" class="form-label">電子郵件</label>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" type="submit">發送驗證碼</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-12">
                                    <p class="mt-4 mb-4">其他登入方式</p>
                                    <div class="d-flex gap-2 gap-sm-3 justify-content-centerX">
                                        <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                            class="btn btn-outline-danger bsb-btn-circle bsb-btn-circle-2xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                            </svg>

                                        </a>
                                        <a href="#!" class="btn btn-outline-primary bsb-btn-circle bsb-btn-circle-2xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                            </svg>
                                        </a>
                                        <a href="#!" class="btn btn-outline-dark bsb-btn-circle bsb-btn-circle-2xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-x-logo" viewBox="0 0 24 24">
                                                <path
                                                    d="M22.54 0H16.9L12 9.22L7.1 0H1.46L9.38 12L0 24h5.64l6.36-10.3L18.36 24H24L14.64 12L22.54 0Z" />
                                            </svg> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- 登入頁面 結束 -->
    <!-- Bootstrap JS -->
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-9/assets/css/registration-9.css">
</body>

</html>