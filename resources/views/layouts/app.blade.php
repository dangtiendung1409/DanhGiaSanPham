<!DOCTYPE html>
<html>
<head>
    <title>Đánh giá sản phẩm</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CDN hoặc link tới file CSS của bạn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.nav') <!-- Nếu có thanh menu -->

    <div class="py-4">
        @yield('content')
    </div>

    <!-- JS nếu cần -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
