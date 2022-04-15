<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/assets/css/bs/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    @yield('css')
</head>

<body>
    @yield('container')

    <!-- BOOTSTRAP 5 -->
    <script src="/assets/js/bs/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>

</html>
