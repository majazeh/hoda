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
        <div class="relative -top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('پیش‌خوان')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md h-96">
                <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
                    <a href="{{ route('tasks.create') }}" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('ساخت یک وظیفه')</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 mt-4">
                    <a href="#" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('گزارش روز قبل')</span>
                    </a>
                    <a href="#" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('گزارش امروز')</span>
                    </a>
                    <a href="#" class="flex items-center bg-white hover:shadow-md transition border border-gray-200 p-4 rounded-md text-purple-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm relative top-0.5 mr-2 variable-font-medium">@lang('تقویم')</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
