<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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
        Task::build($data)->create();
        return redirect()->route('tasks.index');
    }
}
