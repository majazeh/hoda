<?php

namespace App\Models\Task;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task as Model;
use App\Models\Task as ModelsTask;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

abstract class Task
{
    protected Collection $frequencies;
    abstract protected function frequencies(): Collection;

    protected function bind(String $title, bool $qualitative = false, int $coefficient = 1, Carbon $todo_at, String $frequency_type){
        $this->frequencies->add(new Model([
            'title' => $title,
            'qualitative' => $qualitative,
            'coefficient' => $coefficient,
            'todo_at' => $todo_at,
            'frequency_type' => $frequency_type
        ]));
    }

    public function create(){
        $userId = auth()->id();
        foreach($this->frequencies as $frequencie){
            $date = Jalalian::fromCarbon($frequencie->todo_at);
            $year = $date->format('Y');
            $month = $date->format('Y-m');
            $day = $date->format('Y-m-d');
            $weight = $frequencie->coefficient * 10;
            $coefficient = $frequencie->coefficient;
            DB::statement("INSERT INTO reports (`user_id`, `format`, `value`, `total`) VALUES ($userId, 'year', $year, $weight) ON DUPLICATE KEY UPDATE total = total+$weight, coefficient = coefficient + $coefficient");
            DB::statement("INSERT INTO reports (`user_id`, `format`, `value`, `total`) VALUES ($userId, 'month', '$month', $weight) ON DUPLICATE KEY UPDATE total = total+$weight, coefficient = coefficient + $coefficient");
            DB::statement("INSERT INTO reports (`user_id`, `format`, `value`, `total`, `coefficient`) VALUES ($userId, 'day', '$day', $weight, $coefficient) ON DUPLICATE KEY UPDATE total = total+$weight, coefficient = coefficient + $coefficient");
            $frequencie->save();
        }
        return $this->frequencies;
    }
}
