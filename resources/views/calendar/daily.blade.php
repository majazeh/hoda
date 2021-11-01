@extends('calendar.calendar')
@section('content')
<canvas id="myChart" width="400" height="120"></canvas>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels : {!! $tasks->pluck("title")->toJson() !!},
            datasets: [
                {
                label: 'مطلق',
                data: {!! $tasks->pluck("score")->toJson() !!},
                borderColor : "#59bfb2",
                backgroundColor : "#6fd1c4"
            },
            {
                label: 'نسبی',
                data: {!! $tasks->pluck("relative")->toJson() !!},
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
                }
            }
        }
    });
    </script>
@endsection
