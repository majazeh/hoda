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
        <div class="flex items-center w-full lg:w-3/4 mx-auto mb-4 text-gray-800 cursor-default">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h2 class="text-sm variable-font-semibold relative top-0.5">@lang('ساخت وظیفه')</h2>
        </div>
        <div class="w-full lg:w-3/4 mx-auto bg-white border border-gray-200 rounded-md p-4">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="flex flex-col">
                        @foreach ($errors->all() as $error)
                        <div class="bg-red-50 border-r-2 border-red-600 text-red-600 text-xs mb-2 px-2 py-1">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="grid grid-cols-1 xs:grid-cols-2 gap-4">
                    <div>
                        <div>
                            <label for="title" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('عنوان')</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                        </div>
                        <div class="mt-4">
                            <label for="start_at" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('شروع از')</label>
                            <input name="start_at" id="start_at" value="{{ old('start_at') ?:  time()}}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                        </div>
                        <div class="mt-4">
                            <label for="coefficient" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('ضریب')</label>
                            <select name="coefficient" id="coefficient" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                <option disabled selected>انتخاب کنید</option>
                                <option value="1">۱. کارهای کم ارزش</option>
                                <option value="2">۲. کارهای عادی</option>
                                <option value="3">۳. کارهای ارزشمند</option>
                                <option value="4">۴. کارهای پر ازرش</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="frequency_type" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('نحوه تکرار')</label>
                            <select name="frequency_type" id="frequency_type" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                <option disabled selected>دوره تکرار</option>
                                <option value="daily">روزانه</option>
                                <option value="weekly">هفتگی</option>
                                <option value="monthly">ماهانه</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="weekday" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('انتخاب روز هفته')</label>
                            <select name="weekday" id="weekday" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                <option disabled selected>روز هفته</option>
                                <option value="0">شنبه</option>
                                <option value="1">یکشبنه</option>
                                <option value="2">دوشنبه</option>
                                <option value="3">سه‌شنبه</option>
                                <option value="4">چهارشنبه</option>
                                <option value="5">پنج‌شنبه</option>
                                <option value="6">جمعه</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="month_day" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('انتخاب روز ماه')</label>
                            <select name="month_day" id="month_day" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                <option disabled selected>روز ماه</option>
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                <option value="before_last">یک روز مانده به آخر ماه</option>
                                <option value="last_day">روز آخر ماه</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="frequency_count" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('تعداد تکرار')</label>
                            <input type="text" name="frequency_count" id="frequency_count" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <label class="inline-flex group">
                        <input type="checkbox" name="qualitative" id="qualitative" {{ old('qualitative') ? 'checked' : '' }} class="w-3.5 h-3.5 rounded-sm">
                        <span class="text-xs text-gray-600 mr-2 group-hover:text-brand">@lang('این وظیفه، یک وظیفه کیفی است که قصد دارم به صورت «انجام دادم» یا «انجام ندادم» گزارش کنم؛ وظایف کمی نیز یک بازه عددی بین ۰ تا ۱۰ گزارش می‌شوند.')</span>
                    </label>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="flex items-center justify-center text-sm bg-green-700 hover:bg-green-800 transition text-white focus-current ring-green-700 h-8 px-6 rounded-md">@lang('ساخت وظیفه')</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
