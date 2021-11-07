@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('ساخت کاربر')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                <form action="{{ route('users.store') }}" method="POST">
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
                                <label for="name" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('نام')</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                        </div>
                        <div>
                            <label for="mobile" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('موبایل')</label>
                            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                        </div>
                        <div>
                            <label for="password" class="block variable-font-medium text-sm text-gray-700 mb-1">@lang('کلمه عبور')</label>
                            <input type="text" name="password" id="password" value="{{ old('password') }}" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 focus">
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="flex items-center justify-center text-sm bg-green-700 hover:bg-green-800 transition text-white focus-current ring-green-700 h-8 px-6 rounded-md">@lang('ساخت کاربر')</button>
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
