<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <label>
        عنوان
        <input name="title" value="{{ old('title') }}">
    </label>
    <br>
    <label>
        شروع از
        <input name="start_at" value="{{ old('start_at') ?:  time()}}">
    </label>
    <br>
    <label>
        این وظیفه، یک وظیفه کیفی است که قصد دارم به صورت «انجام دادم» یا «انجام ندادم» گزارش کنم؛ وظایف کمی نیز یک بازه عددی بین ۰ تا ۱۰ گزارش می‌شوند
        <input type="checkbox" name="qualitative" {{ old('qualitative') ? 'checked' : '' }}>
    </label>
    <br>
    <label>
        ضریب
        <select name="coefficient">
            <option disabled selected>انتخاب ضریب</option>
            <option value="1">1: کارهای کم ارزش</option>
            <option value="2">2: کارهای عادی</option>
            <option value="3">3: کارهای ارزشمند</option>
            <option value="4">4: کارهای پر ازرش</option>
        </select>
    </label>
    <br>
    <label>
        نحوه تکرار
        <select name="frequency_type">
            <option disabled selected>دوره تکرار</option>
            <option value="daily">روزانه</option>
            <option value="weekly">هفتگی</option>
            <option value="monthly">ماهانه</option>
        </select>
    </label>
    <br>

    <label>
        انتخاب روز هفته
        <select name="weekday">
            <option disabled selected>روز هفته</option>
            <option value="0">شنبه</option>
            <option value="1">یکشبنه</option>
            <option value="2">دوشنبه</option>
            <option value="3">سه‌شنبه</option>
            <option value="4">چهارشنبه</option>
            <option value="5">پنج‌شنبه</option>
            <option value="6">جمعه</option>
        </select>
    </label>
    <br>
    <label>
        انتخاب روز ماه
        <select name="month_day">
            <option disabled selected>روز ماه</option>
            @for ($i = 1; $i <= 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
            <option value="before_last">یک روز مانده به آخر ماه</option>
            <option value="last_day">روز آخر ماه</option>
        </select>
    </label>
    <br>
    <label>
        تعداد تکرار
        <input type="text" name="frequency_count">
    </label>
    <br>
    <button type="submit">
        ساخت وظایف
    </button>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
</body>
</html>
