@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('گزارش')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs sm:text-sm text-gray-600 cursor-default border-r-2 border-gray-400 pr-2">{{ $current->format('%d %B Y') }}</h3>
                    <div class="flex items-center relative" x-data='{"show" : false}'>
                        <a href="{{ route('tasks.report', ['date' => $nav_link->format('Y-m-d')]) }}" class="flex items-center text-xs text-gray-500 h-7 px-2 sm:px-4 border border-gray-300 rounded hover:bg-gray-50 transition" title="{{ $today == $nav_link ? 'گزارش امروز' : 'گزارش روز قبل' }}" aria-label="{{ $today == $nav_link ? 'گزارش امروز' : 'گزارش روز قبل' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="hidden sm:block">{{ $today == $nav_link ? 'گزارش امروز' : 'گزارش روز قبل' }}</span>
                        </a>
                        <a id="calanderNav" class="flex items-center text-xs text-blue-600 h-7 px-2 sm:px-4 border border-blue-600 rounded hover:bg-blue-50 transition mr-2" title="@lang('تقویم')" aria-label="@lang('تقویم')" x-on:click="show = !show;" @hide="show = false; $('#calander').hide()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="mr-2 hidden sm:block">@lang('تقویم')</span>
                        </a>
                        <div class="absolute left-0 top-0" id="calander" x-show="show"></div>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="hidden sm:flex items-center cursor-default px-2 text-xs variable-font-medium text-gray-600 bg-gray-200 py-1 rounded">
                        <div class="flex-none ml-8 hidden sm:block">#</div>
                        <div class="flex-1 px-2">عنوان</div>
                        <div class="flex-1 px-2">ضریب</div>
                        <div class="flex-1 px-2 hidden lg:block">نحوه تکرار</div>
                        <div class="flex-1 px-2">گزارش</div>
                        <div class="flex-1 px-2"></div>
                    </div>
                    @foreach ($tasks as $task)
                        <div class="flex flex-col sm:flex-row sm:items-center cursor-default text-sm text-gray-500 bg-gray-50 p-2 rounded mt-2">
                            <div class="flex-none ml-8 hidden sm:block">{{ $loop->index + 1 }}</div>
                            <div class="flex-1 px-2">
                                <span class="sm:hidden">{{ $loop->index + 1 }}. </span>
                                <span>{{ $task->title }}</span>
                            </div>
                            <div class="flex-1 px-2 mt-1 sm:mt-0">
                                <span class="sm:hidden text-xs text-gray-400">@lang('ضریب:')</span>
                                <span>{{ $task->coefficient }}</span>
                            </div>
                            <div class="flex-1 px-2 hidden lg:block">@lang($task->frequency_type)</div>
                            <div class="flex-1 flex items-center px-2 mt-1 sm:mt-0" id="report_input">
                                <span class="sm:hidden text-xs text-gray-400 ml-2">@lang('گزارش:')</span>
                                @if ($task->qualitative)
                                    <select name="score" id="score" data-id="{{ $task->id }}" class="flex items-center w-24 h-7 pt-0 pb-0 text-xs text-gray-500 border border-gray-300 rounded px-2 focus">
                                        <option selected disabled>انتخاب کنید</option>
                                        <option value="0" {{ $task->score == 0 ? 'selected' : '' }}>انجام نشده</option>
                                        <option value="1" {{ $task->score != 0 ? 'selected' : '' }}>انجام شده</option>
                                    </select>
                                @else
                                    <select name="score" id="score" data-id="{{ $task->id }}" class="flex items-center w-24 h-7 pt-0 pb-0 text-xs text-gray-500 border border-gray-300 rounded px-2 focus">
                                        <option selected disabled></option>
                                        <option value="0"  {{ $task->score == 0  ? 'selected' : '' }}>0</option>
                                        <option value="1"  {{ $task->score == 1 * $task->coefficient  ? 'selected' : '' }}>1</option>
                                        <option value="2"  {{ $task->score == 2 * $task->coefficient  ? 'selected' : '' }}>2</option>
                                        <option value="3"  {{ $task->score == 3 * $task->coefficient  ? 'selected' : '' }}>3</option>
                                        <option value="4"  {{ $task->score == 4 * $task->coefficient  ? 'selected' : '' }}>4</option>
                                        <option value="5"  {{ $task->score == 5 * $task->coefficient  ? 'selected' : '' }}>5</option>
                                    </select>
                                @endif
                            </div>
                            <div class="flex-1 flex px-2 mt-4 sm:mt-0 justify-end">
                                <a href="#" class="text-gray-400 hover:text-blue-600 transition ml-4" title="@lang('ویرایش')" aria-label="@lang('ویرایش')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-red-600 transition" title="@lang('حذف')" aria-label="@lang('حذف')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <script>
        $('#calander').persianDatepicker(
            {
                inline : true,
                maxDate: new Date(),
                format: "YYYY/MM/DD",
                autoClose: true,
                toolbox: {
                    calendarSwitch: {
                        enabled: false,
                    },
                },
                dayPicker : {
                    onSelect : function(unix){
                        const date = new persianDate.unix(unix / 1000)
                        location.href=`/dashboard/tasks/report?date=${date.year()}-${date.month()}-${date.date()}`
                    }
                }
            }
        );
        let closed = true;
        $(document).on('click', function(e){
            if(closed){
                $('#calanderNav')[0].click();
                const cld = $('#calanderNav')[0];
                cld.dispatchEvent(new Event('hide'))
            }else{
                closed = true;
            }
        });
        $('#calander').on('click', function(e){
            if($(e.target).parents('#calander').length){
                closed = false;
            }
        });

    </script>
@endsection
