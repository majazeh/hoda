<header class="h-60 bg-center bg-no-repeat bg-cover py-3" style="background-image: url('{{ asset('/img/hoda-cover.jpg') }}')">
    <div class="container mx-auto px-4 flex items-center justify-between border-b border-white border-opacity-10 pb-4 mb-4">
        <div class="flex items-center">
            <a href="/dashboard" class="text-white text-xl relative top-1 variable-font-bold ml-14">
                <h1>هدا</h1>
            </a>
            <div class="hidden sm:flex items-center relative top-1 text-sm">
                @if (auth()->id() == 1)
                    <a href="{{ route('users.create') }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('ساخت کاربر')</a>
                    <a href="{{ route('users.index') }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('لیست کاربران')</a>
                @endif
                <a href="{{ route('tasks.create') }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('ساخت یک وظیفه')</a>
                <a href="{{ route('tasks.index') }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('لیست وظایف')</a>
                <a href="{{ route('tasks.report') }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('گزارش‌دهی امروز')</a>
                <a href="{{ route('tasks.report', ['date' => Morilog\Jalali\Jalalian::now()->subDays()->format('Y-m-d')]) }}" class="text-gray-200 hover:text-blue-400 transition ml-8">@lang('گزارش‌دهی روز قبل')</a>
                <a href="{{ route('calendar.daily') }}" class="text-gray-200 hover:text-blue-400 transition">@lang('تقویم')</a>
            </div>
        </div>
        <a href="/dashboard/logout" class="flex items-center text-white hover:shadow-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="text-xs mr-1">خروج</span>
        </a>
    </div>
    <div class="container mx-auto px-4 flex items-center mb-4 sm:hidden">
        <select name="menu" id="menu" class="w-full rounded-md px-6 text-gray-700" onchange="location.href = this.value">
            <option selected disabled>فهرست</option>
            @if (auth()->id() == 1)
                <option value="{{ route('users.create') }}">@lang('ساخت کاربر')</option>
                <option value="{{ route('users.index') }}">@lang('لیست کاربران')</option>
            @endif
            <option value="{{ route('tasks.create') }}">@lang('ساخت وظیفه')</option>
            <option value="{{ route('tasks.index') }}">@lang('ساخت وظیفه')</option>
            <option value="{{ route('tasks.report') }}">@lang('گزارش‌دهی امروز')</option>
            <option value="{{ route('tasks.report', ['date' => Morilog\Jalali\Jalalian::now()->subDays()->format('Y-m-d')]) }}">@lang('گزارش‌دهی روز قبل')</option>
            <option value="{{ route('calendar.daily') }}">@lang('تقویم')</option>
        </select>
    </div>
</header>
