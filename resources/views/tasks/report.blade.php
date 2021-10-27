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
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('گزارش امروز')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs sm:text-sm text-gray-600 cursor-default border-r-2 border-gray-400 pr-2">13 آبان 1400</h3>
                    <div class="flex items-center">
                        <a href="#" class="flex items-center text-xs text-gray-500 h-7 px-2 sm:px-4 border border-gray-300 rounded hover:bg-gray-50 transition" title="@lang('گزارش روز قبل')" aria-label="@lang('گزارش روز قبل')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="hidden sm:block">@lang('گزارش روز قبل')</span>
                        </a>
                        <a href="#" class="flex items-center text-xs text-blue-600 h-7 px-2 sm:px-4 border border-blue-600 rounded hover:bg-blue-50 transition mr-2" title="@lang('تقویم')" aria-label="@lang('تقویم')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="mr-2 hidden sm:block">@lang('تقویم')</span>
                        </a>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="hidden sm:flex items-center cursor-default px-2 text-xs variable-font-medium text-gray-600 bg-gray-200 py-1 rounded">
                        <div class="flex-none ml-8 hidden sm:block">#</div>
                        <div class="flex-1 px-2">عنوان</div>
                        <div class="flex-1 px-2">ضریب</div>
                        <div class="flex-1 px-2 hidden lg:block">نحوه تکرار</div>
                        <div class="flex-1 px-2">گزارش</div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center cursor-default text-sm text-gray-500 bg-gray-50 p-2 rounded mt-2">
                        <div class="flex-none ml-8 hidden sm:block">1</div>
                        <div class="flex-1 px-2">
                            <span class="sm:hidden">1. </span>
                            <span>بررسی مقالات سال 99</span>
                        </div>
                        <div class="flex-1 px-2 mt-1 sm:mt-0">
                            <span class="sm:hidden text-xs text-gray-400">@lang('ضریب:')</span>
                            <span>3</span>
                        </div>
                        <div class="flex-1 px-2 hidden lg:block">هفتگی</div>
                        <div class="flex-1 px-2 mt-1 sm:mt-0">
                            <span class="sm:hidden text-xs text-gray-400">@lang('گزارش:')</span>
                            <input type="checkbox" class="w-3.5 h-3.5 rounded-sm border-gray-400">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center  cursor-default text-sm text-gray-500 bg-gray-50 p-2 rounded mt-2">
                        <div class="flex-none ml-8 hidden sm:block">2</div>
                        <div class="flex-1 px-2">
                            <span class="sm:hidden">2. </span>
                            <span>مشاهده ویدئوهای 5 تا 10 وردپرس</span>
                        </div>
                        <div class="flex-1 px-2 mt-1 sm:mt-0">
                            <span class="sm:hidden text-xs text-gray-400">@lang('ضریب:')</span>
                            <span>1</span>
                        </div>
                        <div class="flex-1 px-2 hidden lg:block">روزانه</div>
                        <div class="flex-1 px-2 mt-1 sm:mt-0">
                            <span class="sm:hidden text-xs text-gray-400">@lang('گزارش:')</span>
                            <select name="score" id="score" class="w-16 h-6 pt-1 text-xs text-gray-500 border border-gray-300 rounded-md px-2 focus">
                                <option selected value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
