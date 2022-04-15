<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="/assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- BOXICON -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- SELECT 2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{asset ('/assets/js/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{asset ('/assets/js/select2/dist/js/select2.min.js')}}"></script>

    <!-- css -->
    {{-- INI LANDING PAGE CSS DITARO PER LANDING PAGE --}}
    {{-- <link rel="stylesheet" href="{{asset ('/assets/css/landingpage.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset ('/assets/css/style.css')}}"> --}}

    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset ('/assets/js/owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset ('/assets/js/owlcarousel/dist/assets/owl.theme.default.min.css')}}">

    <link rel="shortcut icon" href="{{ asset('/assets/img/imp/bkk-icon.png') }}" type="image/x-icon">

    <title>@yield('title')</title>

    @yield('css')
</head>
<body>

    @yield('container')

    <script src="/assets/js/bs/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>

</html>
