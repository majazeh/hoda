@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('وظایف')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">

                <div class="mt-8">
                    <div class="hidden sm:flex items-center cursor-default px-2 text-xs variable-font-medium text-gray-600 bg-gray-200 py-1 rounded">
                        <div class="flex-none ml-8 hidden sm:block">#</div>
                        <div class="flex-1 px-2">عنوان</div>
                        <div class="flex-1 px-2"></div>
                    </div>
                    @foreach ($tasks as $task)
                        <div class="flex flex-col sm:flex-row sm:items-center cursor-default text-sm text-gray-500 bg-gray-50 p-2 rounded mt-2">
                            <div class="flex-none ml-8 hidden sm:block">{{ $loop->index + 1 }}</div>
                            <div class="flex-1 px-2">
                                <span class="sm:hidden">{{ $loop->index + 1 }}. </span>
                                <a href="{{ route('tasks.show', $task->title) }}">{{ $task->title }}</a>
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
