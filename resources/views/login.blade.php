@extends('layouts.app')


@section('content')
<!-- 登入頁面 開始 -->
<section class="bg-primary py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-12 col-md-6 col-xl-7">
                <div class="d-flex justify-content-center text-bg-primary">
                    <div class="col-12 col-xl-9">
                        <hr class="border-primary-subtle mb-4">
                        <h2 class="h1 mb-4">TaiwanTravel</h2>
                        <p class="lead mb-5">請選擇電子郵件驗證登入或者手機簡訊驗證登入</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-5">
                <div class="card border-0 rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <!-- Pills navs -->
                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-email-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-email" type="button" role="tab"
                                    aria-controls="pills-email" aria-selected="true">EMAIL驗證登入</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-SMS-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-SMS" type="button" role="tab" aria-controls="pills-SMS"
                                    aria-selected="false">手機驗證登入</button>
                            </li>
                        </ul>

                        <!-- Pills content -->
                        <div class="tab-content" id="pills-tabContent">
                            <!-- EMAIL驗證 -->
                            <div class="tab-pane fade show active" id="pills-email" role="tabpanel"
                                aria-labelledby="pills-email-tab">
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
                                    <!-- 隱藏字段用於指定驗證類型-->
                                    <input type="hidden" name="type" id="type" value="email">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit">傳送驗證碼</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- 手機簡訊驗證 -->
                            <div class="tab-pane fade" id="pills-SMS" role="tabpanel"
                                aria-labelledby="pills-SMS-tab">
                                <form method="POST" action="/send-verification-code">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Your Username" required>
                                        <label for="username" class="form-label">使用者名稱</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" name="phone" id="phone"
                                            placeholder="Your Phone Number" required pattern="[0-9]{10}">
                                        <label for="phone" class="form-label">手機號碼</label>
                                    </div>
                                    <!-- 隱藏字段用於指定驗證類型-->
                                    <input type="hidden" name="type" id="type" value="sms">
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit">傳送驗證碼</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="mt-4 mb-4">其他登入方式</p>
                                <div class="d-flex gap-2 gap-sm-3 justify-content-centerX">
                                    <!-- Google 登入按鈕 -->
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                        class="btn btn-outline-danger rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                            <path
                                                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                        </svg>
                                    </a>
                                    <!-- LINE 登入按鈕 -->
                                    <a href="{{ route('social.login', ['provider' => 'line']) }}"
                                        class="btn btn-outline-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-line" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0c4.411 0 8 2.912 8 6.492 0 1.433-.555 2.723-1.715 3.994-1.678 1.932-5.431 4.285-6.285 4.645-.83.35-.734-.197-.696-.413l.003-.018.114-.685c.027-.204.055-.521-.026-.723-.09-.223-.444-.339-.704-.395C2.846 12.39 0 9.701 0 6.492 0 2.912 3.59 0 8 0M5.022 7.686H3.497V4.918a.156.156 0 0 0-.155-.156H2.78a.156.156 0 0 0-.156.156v3.486c0 .041.017.08.044.107v.001l.002.002.002.002a.15.15 0 0 0 .108.043h2.242c.086 0 .155-.07.155-.156v-.56a.156.156 0 0 0-.155-.157m.791-2.924a.156.156 0 0 0-.156.156v3.486c0 .086.07.155.156.155h.562c.086 0 .155-.07.155-.155V4.918a.156.156 0 0 0-.155-.156zm3.863 0a.156.156 0 0 0-.156.156v2.07L7.923 4.832l-.013-.015v-.001l-.01-.01-.003-.003-.011-.009h-.001L7.88 4.79l-.003-.002-.005-.003-.008-.005h-.002l-.003-.002-.01-.004-.004-.002-.01-.003h-.002l-.003-.001-.009-.002h-.006l-.003-.001h-.004l-.002-.001h-.574a.156.156 0 0 0-.156.155v3.486c0 .086.07.155.156.155h.56c.087 0 .157-.07.157-.155v-2.07l1.6 2.16a.2.2 0 0 0 .039.038l.001.001.01.006.004.002.008.004.007.003.005.002.01.003h.003a.2.2 0 0 0 .04.006h.56c.087 0 .157-.07.157-.155V4.918a.156.156 0 0 0-.156-.156zm3.815.717v-.56a.156.156 0 0 0-.155-.157h-2.242a.16.16 0 0 0-.108.044h-.001l-.001.002-.002.003a.16.16 0 0 0-.044.107v3.486c0 .041.017.08.044.107l.002.003.002.002a.16.16 0 0 0 .108.043h2.242c.086 0 .155-.07.155-.156v-.56a.156.156 0 0 0-.155-.157H11.81v-.589h1.525c.086 0 .155-.07.155-.156v-.56a.156.156 0 0 0-.155-.157H11.81v-.589h1.525c.086 0 .155-.07.155-.156Z" />
                                        </svg>
                                    </a>
                                    <!-- Twitter 登入按鈕 -->
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                        class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                            <path
                                                d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                        </svg>
                                    </a>
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

@endsection