@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('کاربران')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">

                <div class="mt-8">
                    <div class="hidden sm:flex items-center cursor-default px-2 text-xs variable-font-medium text-gray-600 bg-gray-200 py-1 rounded">
                        <div class="flex-none ml-8 hidden sm:block">#</div>
                        <div class="flex-1 px-2">نام</div>
                        <div class="flex-1 px-2">موبایل</div>
                        <div class="flex-1 px-2"></div>
                    </div>
                    @foreach ($users as $user)
                        <div class="flex flex-col sm:flex-row sm:items-center cursor-default text-sm text-gray-500 bg-gray-50 p-2 rounded mt-2">
                            <div class="flex-none ml-8 hidden sm:block">{{ $user->id }}</div>
                            <div class="flex-1 px-2">
                                <span class="sm:hidden">{{ $user->id }}. </span>
                                <a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a>
                            </div>
                            <div class="flex-1 px-2">
                                {{ $user->mobile }}
                            </div>
                            <div class="flex-1 flex px-2 mt-4 sm:mt-0 justify-end">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-gray-400 hover:text-blue-600 transition ml-4" title="@lang('ویرایش')" aria-label="@lang('ویرایش')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </main>
@endsection
