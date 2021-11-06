@extends('app')
@section('main')
    <main class="container mx-auto px-4 py-8">
        <div class="relative -top-32 sm:-top-44">
            <h2 class="text-lg variable-font-semibold text-white cursor-default">@lang('تقویم')</h2>
            <div class="bg-white rounded-lg p-8 mt-4 shadow-md">
                <div class="mt-8">
                    <canvas id="Week" width="400" height="120"></canvas>
                    <script>
                        const Week = new Chart(document.getElementById('Week').getContext('2d'), {
                            type: 'line',
                            data: {
                                labels : {!! $week->pluck("jalaliTodoAt")->map(function($time){ return $time->format('%A');})->toJson() !!},
                                datasets: [
                                    {
                                    label: 'مطلق',
                                    data: {!! $week->pluck("score")->toJson() !!},
                                    borderColor : "#59bfb2",
                                    backgroundColor : "#6fd1c4"
                                },
                                {
                                    label: 'نسبی',
                                    data: {!! $week->pluck("relative")->toJson() !!},
                                    borderColor : "#598fbf",
                                    backgroundColor : "#699ac5"
                                }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'نمودار هفته'
                                    }
                                }
                            }
                        });
                    </script>
                </div>
                <div class="mt-8">
                    <canvas id="Month" width="400" height="120"></canvas>
                    <script>
                        const Month = new Chart(document.getElementById('Month').getContext('2d'), {
                            type: 'line',
                            data: {
                                labels : {!! $month->pluck("jalaliTodoAt")->map(function($time){ return $time->format('m-d');})->toJson() !!},
                                datasets: [
                                    {
                                    label: 'مطلق',
                                    data: {!! $month->pluck("score")->toJson() !!},
                                    borderColor : "#59bfb2",
                                    backgroundColor : "#6fd1c4"
                                },
                                {
                                    label: 'نسبی',
                                    data: {!! $month->pluck("relative")->toJson() !!},
                                    borderColor : "#598fbf",
                                    backgroundColor : "#699ac5"
                                }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'نمودار ماه'
                                    }
                                }
                            }
                        });
                        </script>
                </div>
                <div class="mt-8">
                    <canvas id="All" width="400" height="120"></canvas>
                    <script>
                        const All = new Chart(document.getElementById('All').getContext('2d'), {
                            type: 'line',
                            data: {
                                labels : {!! $tasks->pluck("jalaliTodoAt")->map(function($time){ return $time->format('Y-m-d');})->toJson() !!},
                                datasets: [
                                    {
                                    label: 'مطلق',
                                    data: {!! $tasks->pluck("score")->toJson() !!},
                                    borderColor : "rgba(0, 0, 0, 0)",
                                    backgroundColor : "#6fd1c4"
                                },
                                {
                                    label: 'نسبی',
                                    data: {!! $tasks->pluck("relative")->toJson() !!},
                                    borderColor : "rgba(0, 0, 0, 0)",
                                    backgroundColor : "#699ac5"
                                }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'نمودار کل'
                                    }
                                }
                            }
                        });
                        </script>
                </div>
            </div>
        </div>
    </main>
@endsection
