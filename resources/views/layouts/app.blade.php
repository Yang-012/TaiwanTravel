<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelHub</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery 的 CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- 全局自定義 -->
    <style>
        /* 將Bootstrap中的primary改為#a2eafa*/
        [class*="-primary"] {
            background-color: #a2eafa !important;
            border-color: #a2eafa !important;
            color: #000 !important;
        }
    </style>
    @stack('styles') <!-- 局部自定義 -->
</head>

<body>
    <!-- 導覽列 -->
    @include('partials.navbar')

    <!-- 主內容區域 -->
    @yield('content')

    <!-- footer -->
    <footer class="text-center">
        <p>&copy; {{ date('Y') }} TarvelHub. All rights reserved.</p>
    </footer>

</body>


</html>