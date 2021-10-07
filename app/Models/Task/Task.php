<?php

namespace App\Models\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task as Model;
abstract class Task
{
    protected Collection $frequencies;
    abstract protected function frequencies(): Collection;

    protected function bind(String $title, bool $qualitative = false, int $coefficient = 1, Carbon $todo_at){
        $this->frequencies->add(new Model([
            'title' => $title,
            'qualitative' => $qualitative,
            'coefficient' => $coefficient,
            'todo_at' => $todo_at,
        ]));
    }

    public function create(){
        foreach($this->frequencies as $frequencie){
            $frequencie->save();
        }
        return $this->frequencies;
    }
}
