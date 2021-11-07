@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang(isset($task) ? "ویرایش {$task->title} در {$task->JalaliTodoAt->format('%d %B Y')}" : 'ساخت وظیفه')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST" x-data='{"frequency_type" : null}'>
                    @csrf
                    @method(isset($task) ? 'PUT' : 'POST')
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
                                <input type="text" name="title" id="title" value="{{ old('title') || isset($task) ? $task->title : null }}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                            </div>
                            @if (!isset($task))
                                <div class="mt-4">
                                    <label for="start_at_picker" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('شروع از')</label>
                                    <input id="start_at_picker" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                    <input type="hidden" name="start_at" id="start_at" value="{{ old('start_at') ?:  time()}}">
                                </div>
                            @endif
                            <div class="mt-4">
                                <label for="coefficient" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('ضریب')</label>
                                <select name="coefficient" id="coefficient" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus">
                                    <option disabled selected>انتخاب کنید</option>
                                    <option value="1" {{ isset($task) && $task->coefficient == 1 ? 'selected' : null}}>۱. کارهای کم ارزش</option>
                                    <option value="2" {{ isset($task) && $task->coefficient == 2 ? 'selected' : null}}>۲. کارهای عادی</option>
                                    <option value="3" {{ isset($task) && $task->coefficient == 3 ? 'selected' : null}}>۳. کارهای ارزشمند</option>
                                    <option value="4" {{ isset($task) && $task->coefficient == 4 ? 'selected' : null}}>۴. کارهای پر ارزش</option>
                                </select>
                            </div>
                        </div>
                        @if (!isset($task))
                            <div>
                                <div>
                                    <label for="frequency_type" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('نحوه تکرار')</label>
                                    <select name="frequency_type" id="frequency_type" class="w-full text-xs text-gray-600 border border-gray-300 rounded-md h-8 px-2 focus" x-model="frequency_type">
                                        <option disabled selected>دوره تکرار</option>
                                        <option value="daily">روزانه</option>
                                        <option value="weekly">هفتگی</option>
                                        <option value="monthly">ماهانه</option>
                                    </select>
                                </div>
                                <div class="mt-4" x-show="frequency_type == 'weekly'">
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
                                <div class="mt-4" x-show="frequency_type == 'monthly'">
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
                        @endif
                    </div>
                    <div class="mt-6">
                        <label class="inline-flex group">
                            <input type="checkbox" name="qualitative" id="qualitative" {{ old('qualitative') || isset($task) && $task->qualitative ? 'checked' : '' }} class="w-3.5 h-3.5 rounded-sm">
                            <span class="text-xs text-gray-600 mr-2 group-hover:text-brand">@lang('این وظیفه، یک وظیفه کیفی است که قصد دارم به صورت «انجام دادم» یا «انجام ندادم» گزارش کنم؛ وظایف کمی نیز یک بازه عددی بین ۰ تا ۱۰ گزارش می‌شوند.')</span>
                        </label>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="flex items-center justify-center text-sm bg-green-700 hover:bg-green-800 transition text-white focus-current ring-green-700 h-8 px-6 rounded-md">@lang(isset($task) ? 'ویرایش' : 'ساخت وظیفه')</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        $('#start_at_picker').persianDatepicker(
            {
                "format": "YYYY/MM/DD",
                "autoClose": true,
                "altFormat": "X",
                "altField": "#start_at",
                "toolbox": {
                    "calendarSwitch": {
                        "enabled": false,
                    },
                }
            }
        );
    </script>
@endsection
