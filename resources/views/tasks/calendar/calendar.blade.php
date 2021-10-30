<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('Create Task')</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="bg-gray-100">
    @include('header')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('تقویم')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                @include('tasks.calendar.filter')
                @include('tasks.calendar.weekly')
                {{-- @include('tasks.calendar.monthly') --}}
                {{-- @include('tasks.calendar.yearly') --}}
            </div>
        </div>
    </main>
</body>
</html>
