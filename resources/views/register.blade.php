<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('Hoda') | @lang('Login')</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="flex min-h-screen">
        <div class="flex-1 flex items-center justify-center flex-col p-4">
            <div class="mx-auto mb-12">
                <h1 class="variable-font-bold text-6xl">هدا</h1>
            </div>
            <div class="w-full xs:w-80">
                <form class="flex flex-col" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="mobile" class="block variable-font-medium text-sm text-gray-700 mb-2">@lang('موبایل')</label>
                        <input type="text" name="mobile" id="mobile" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 pt-3 text-left dir-ltr focus">
                    </div>
                    <div>
                        <label for="name" class="block variable-font-medium text-sm text-gray-700 mb-2">@lang('نام')</label>
                        <input type="text" name="name" id="name" class="w-full text-sm text-gray-600 border border-gray-300 rounded-md h-8 pt-3 text-right dir-rtl focus">
                    </div>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 transition text-white focus-current ring-green-700 mt-4 h-8 rounded-md">ثبت‌نام</button>
                    <a href="{{ route('loginForm') }}" class="bg-gray-50 hover:bg-gray-100 transition text-gray focus-current ring-gray-50 mt-4 h-8 rounded-md text-center">رفتن به صفحه ورود</a>
                </form>
                @if ($errors->any())
                    <div class="flex flex-col">
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-50 border-r-2 border-red-600 text-red-600 text-xs mt-2 px-2 py-1">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="flex-1 items-center justify-center bg-gray-50 hidden md:flex">
            <div class="w-80">
                <img src="./img/Login.svg" alt="Login">
            </div>
        </div>
    </div>
</body>
</html>
