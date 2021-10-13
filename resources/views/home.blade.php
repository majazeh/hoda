<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('Dashboard')</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="bg-gray-100">
    @include('header')
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
            <a href="#" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('لیست وظایف')</span>
            </a>
            <a href="{{ route('tasks.create') }}" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('ساخت یک وظیفه')</span>
            </a>
        </div>
    </main>
</body>
</html>
