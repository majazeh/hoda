@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('تقویم')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                @include('calendar.filter')
                <div class="mt-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
@endsection
