<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CalendarController extends Controller
{
    public function daily(Request $request){
        $data = [];
        $data['type'] = 'daily';
        $date = Jalalian::now();
        $tasks = Task::where('user_id', auth()->id())->where([
            ['todo_at', '>=', $date->toCarbon()->format('Y-m-d')],
            ['todo_at', '<', $date->toCarbon()->addDay()->format('Y-m-d')],
        ])->get();
        $data['tasks'] = $tasks;
        $data['title'] = "برنامه روز ". $date->format('%d %B Y');
        return view('calendar.daily', $data);
    }
    public function weekly(Request $request){
        $data = [];
        $data['type'] = 'weekly';
        $date = Jalalian::now()->getDayOfWeek();
        $first = $date ? Jalalian::now()->subDays($date): Jalalian::now();
        $last = $first->addDays(7);
        $days = Report::where('user_id', auth()->id())->week($first);
        $data['days'] = $days;
        return view('calendar.weekly', $data);
    }
    public function monthly(Request $request){
        $data = [];
        $data['type'] = 'monthly';
        $date = Jalalian::now();
        $first = $date->getDay() != 1 ? Jalalian::now()->subDays($date->getDay()  - 1): Jalalian::now();
        $last = (clone $first)->addDays($date->getMonthDays());
        $days = Report::where('user_id', auth()->id())->month($first, $last);
        $data['days'] = $days;
        return view('calendar.monthly', $data);
    }
    public function yearly(Request $request){
        $data = [];
        $data['type'] = 'yearly';
        $date = Jalalian::now();
        $months = Report::where('user_id', auth()->id())->year($date->getYear());
        $data['months'] = $months;
        return view('calendar.yearly', $data);
    }
}
