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