<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaiwanTravel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 自定義顏色 -->
    <style>
        /* 將Bootstrap中的primary改為#a2eafa */
        .bg-primary {
            background-color: #a2eafa !important;
        }
        .btn-primary {
            background-color: #a2eafa !important;
            border-color: #a2eafa !important;
            color: #000 !important;
        }
        .text-bg-primary {
            background-color: #a2eafa !important;
            color: #000 !important;
        }
        /* login 頁面的pills nav */
        .nav-pills .nav-link.active {
            background-color: #f9d458;
            color: #000;
            border: 1px solid #f9d458;
            border-radius: 10px; 
        }
    </style>
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