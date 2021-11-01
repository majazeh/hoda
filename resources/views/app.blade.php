<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('Dashboard')</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/pwt.datepicker/css/persian-datepicker.min.css">
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script defer src="/js/alpinejs"></script>
    <script src="/js/persian-date.min.js"></script>
    <script src="/js/main.js?_={{ filemtime(public_path('/js/main.js')) }}" defer></script>
    <script src="/pwt.datepicker/js/persian-datepicker.min.js"></script>
    <script src="/js/chart.min.js"></script>
</head>
<body class="bg-gray-100">
    @include('header')
    @yield('main')
</body>
</html>
