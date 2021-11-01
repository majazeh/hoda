<div class="flex flex-col sm:flex-row items-center justify-between border-b border-gray-100 pb-4 mb-4">
    <div class="calendar-filter flex items-center">
        <a href="{{ $type == 'daily' ? '' : route('calendar.daily') }}" class="ml-2 {{ $type == 'daily' ? 'active' : null }}" title="@lang('روزانه')" aria-label="@lang('روزانه')">@lang('روزانه')</a>
        <a href="{{ $type == 'weekly' ? '' : route('calendar.weekly') }}" class="ml-2 {{ $type == 'weekly' ? 'active' : null }}"  title="@lang('هفتگی')" aria-label="@lang('هفتگی')">@lang('هفتگی')</a>
        <a href="{{ $type == 'monthly' ? '' : route('calendar.monthly') }}" class="ml-2 {{ $type == 'monthly' ? 'active' : null }}"  title="@lang('ماهانه')" aria-label="@lang('ماهانه')">@lang('ماهانه')</a>
        <a href="{{ $type == 'yearly' ? '' : route('calendar.yearly') }}" class="{{ $type == 'yearly' ? 'active' : null }}"  class="" title="@lang('سالانه')" aria-label="@lang('سالانه')">@lang('سالانه')</a>
    </div>
    <div class="next-prev flex items-center mt-4 sm:mt-0">
        <a href="#" class="ml-2" title="@lang('قبلی')" aria-label="@lang('قبلی')">@lang('قبلی')</a>
        <a href="#" class="" title="@lang('بعدی')" aria-label="@lang('بعدی')">@lang('بعدی')</a>
    </div>
</div>
