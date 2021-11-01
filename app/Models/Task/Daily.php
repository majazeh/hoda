<?php

namespace App\Models\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Daily extends Task
{
    private Carbon $toDoAt;
    public function __construct(
        private String $title,
        private Carbon $startAt,
        private bool $qualitative = false,
        private int $coefficient = 1,
        private int $count,
    ){
        $this->frequencies = new Collection();
        $this->toDoAt = $startAt;
        $this->frequencies();

    }
    protected function frequencies(): Collection
    {
        $count = 0;
        do{
            $this->bind(
                $this->title,
                $this->qualitative,
                $this->coefficient,
                $this->toDoAt,
                'daily'
            );
            $this->toDoAt = $this->toDoAt->addDay();
            $count++;
        }while($count < $this->count);
        return $this->frequencies;
    }
}
