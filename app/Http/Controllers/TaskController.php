<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class TaskController extends Controller
{

    public function report(Request $request){
        $dateString = $request->date;
        try{
            if(!preg_match("/^(\d{4})-(\d{1,2})-(\d{1,2})$/", $dateString, $dateArray)){
                throw new Exception('bug');
            }
            $date = new Jalalian($dateArray[1], $dateArray[2], $dateArray[3]);
            if(Jalalian::now()->getTimestamp() < $date->getTimestamp()){
                throw new Exception('bug');
            }
        }catch(Exception $e){
            $date = Jalalian::now();
        }
        $data = [];
        $query = Task::where('user_id', auth()->id())->where([
            ['todo_at', '>=', $date->toCarbon()->format('Y-m-d')],
            ['todo_at', '<', $date->toCarbon()->addDay()->format('Y-m-d')],
        ])->get();
        $data['tasks'] = $query;
        $data['current'] = $date;
        $data['today'] = Jalalian::now();
        $data['nav_link'] = $date->toCarbon()->format('Y-m-d')  == Carbon::now()->format('Y-m-d') ? (clone $date)->subDays() : Jalalian::now();
        return view('tasks.report', $data);
    }

    public function index(Request $request){
        $query = Task::where('user_id', auth()->id())
        ->groupBy('title')->select('title');
        return view('tasks.index', ['tasks' => $query->get()]);
    }

    public function show(Request $request, $title){
        $query = Task::where('user_id', auth()->id())->where('title', $title)->get();
        $current = Jalalian::now();
        $startOfWeek = $current->getDayOfWeek() ? (clone $current)->subDays($current->getDayOfWeek()) : clone $current;
        $endOfWeek = (int) (clone $startOfWeek)->addDays(6)->toCarbon()->format('Ymd');
        $startOfWeek = (int) $startOfWeek->toCarbon()->format('Ymd');
        $week = $query->where('toDoDate', '>=', $startOfWeek)->where('toDoDate', '<=', $endOfWeek);

        $startOfMonth =(int) (new Jalalian($current->getYear(), $current->getMonth(), 1))->toCarbon()->format('Ymd');
        $endOfMonth = (int) (new Jalalian($current->getYear(), $current->getMonth(), $current->getMonthDays()))->toCarbon()->format('Ymd');
        $month = $query->where('toDoDate', '>=', $startOfMonth)->where('toDoDate', '<=', $endOfMonth);

        $data = [
            'tasks' => $query,
            'week' => $week,
            'month' => $month
        ];
        $data['title'] = $title;

        return view('tasks.show', $data);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|min:3|max:150',
            'start_at' => 'required|integer|numeric',
            'qualitative' => 'nullable',
            'coefficient' => 'required|in:1,2,3,4',
            'frequency_type' => 'required|in:daily,weekly,monthly',
            'frequency_count' => 'required|integer|numeric|min:1|max:365',
            'weekday' => "required_if:frequency_type,weekly|in:0,1,2,3,4,5,6",
            'month_day' => "required_if:frequency_type,monthly|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,before_last,last_day",
        ]);
        $tasks = Task::build($data);
        DB::beginTransaction();
        DB::raw('LOCK TABLES tasks WRITE');
        $tasks->create();
        DB::commit();
        return redirect()->route('tasks.report');
    }

    public function reportStore(Request $request, Task $task){
        $this->authorize('create', [Report::class, $task]);
        $request->validate([
            'value' => [
                'required',
                'in:' . ($task->qualitative ? '0,1' : '0,1,2,3,4,5,6,7,8,9,10')
            ]
        ]);
        DB::beginTransaction();
        $report = $reportQuery = $task->coefficient * ((int) $request->value);
        if($task->reported_at){
            $reportQuery = "$report - {$task->score}";
        }
        $userID = auth()->id();
        $date = Jalalian::fromCarbon($task->todo_at);
        $year = $date->format('Y');
        $month = $date->format('Y-m');
        $day = $date->format('Y-m-d');
        DB::statement("UPDATE reports SET reported = reported + $reportQuery where user_id = $userID AND `format` = 'year' AND `value` = '$year'");
        DB::statement("UPDATE reports SET reported = reported + $reportQuery where user_id = $userID AND `format` = 'month' AND `value` = '$month'");
        DB::statement("UPDATE reports SET reported = reported + $reportQuery where user_id = $userID AND `format` = 'day' AND `value` = '$day'");
        $task->update([
            'score' => $report,
            'reported_at' => Carbon::now()
        ]);
        DB::commit();
    }

    public function destroy(Task $task){
        $this->authorize('delete', $task);
        DB::beginTransaction();
        $task->delete();
        $userID = auth()->id();
        $date = Jalalian::fromCarbon($task->todo_at);
        $year = $date->format('Y');
        $month = $date->format('Y-m');
        $day = $date->format('Y-m-d');
        $taskScore = $task->score;
        $date = Jalalian::fromCarbon($task->todo_at);
        $year = $date->format('Y');
        $month = $date->format('Y-m');
        $day = $date->format('Y-m-d');
        $weight = $task->coefficient * 10;
        $coefficient = $task->coefficient;
        DB::statement("UPDATE `reports` SET total = total-$weight, coefficient = coefficient - $coefficient WHERE `format` = 'year' AND `value` = '$year'");
        DB::statement("UPDATE `reports` SET total = total-$weight, coefficient = coefficient - $coefficient WHERE `format` = 'month' AND `value` = '$month'");
        DB::statement("UPDATE `reports` SET total = total-$weight, coefficient = coefficient - $coefficient WHERE `format` = 'day' AND `value` = '$day'");
        DB::commit();
        return back();
    }

    public function edit(Task $task){
        $this->authorize('delete', $task);
        return view('tasks.create', ['task' => $task]);
    }
    public function update(Request $request, Task $task){
        $this->authorize('delete', $task);
        $data = $request->validate([
            'title' => 'required|min:3|max:150',
            'qualitative' => 'nullable',
            'coefficient' => 'required|in:1,2,3,4'
        ]);
        if(isset($data['qualitative'])){
            $data['qualitative'] = true;
        }
        $oldScore = $task->score;
        if($task->score && ((isset($data['qualitative']) && $data['qualitative'] != $task->qualitative) || ($data['coefficient'] != $task->coefficient))){
            if(isset($data['qualitative']) && $data['qualitative'] == true && !$task->qualitative){
                $task->score = $task->coefficient * 5;
            }
            $data['score'] = ($task->score / $task->coefficient) * $data['coefficient'];
        }
        DB::beginTransaction();
        $reported = 'reported';
        if(isset($data['score'])){
            if($data['score'] > $oldScore){
                $reported = "reported + ". ($data['score'] - $oldScore);
            }elseif($data['score'] < $oldScore){
                $reported = "reported - ". ($oldScore - $data['score']);
            }
        }
        $coefficient = 'coefficient';
        if(isset($data['coefficient']) && $data['coefficient'] != $task->coefficient){
            if($data['coefficient'] > $task->coefficient){
                $coefficient = "coefficient + ". ($data['coefficient'] - $task->coefficient);
            }elseif($data['coefficient'] < $task->coefficient){
                $coefficient = "coefficient - ". ($task->coefficient - $data['coefficient']);
            }
        }
        $userID = auth()->id();
        $date = Jalalian::fromCarbon($task->todo_at);
        $year = $date->format('Y');
        $month = $date->format('Y-m');
        $day = $date->format('Y-m-d');
        DB::statement("UPDATE reports SET reported = $reported, coefficient = $coefficient where user_id = $userID AND `format` = 'year' AND `value` = '$year'");
        DB::statement("UPDATE reports SET reported = $reported, coefficient = $coefficient where user_id = $userID AND `format` = 'month' AND `value` = '$month'");
        DB::statement("UPDATE reports SET reported = $reported, coefficient = $coefficient where user_id = $userID AND `format` = 'day' AND `value` = '$day'");
        $task->update($data);
        DB::commit();
        return back();
    }
}
