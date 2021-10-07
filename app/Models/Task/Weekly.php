<?php

namespace App\Models\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Morilog\Jalali\Jalalian;

class Weekly extends Task
{
    private Carbon $toDoAt;
    public function __construct(
        private String $title,
        private Carbon $startAt,
        private bool $qualitative = false,
        private int $coefficient = 1,
        private int $count,
        private int $day,
    ){
        $this->frequencies = new Collection();
        $dayOfWeek = Jalalian::fromCarbon(Carbon::now())->getDayOfWeek();
        if($dayOfWeek == $day){
            $this->toDoAt = $startAt;
        }elseif($day > $dayOfWeek){
            $this->toDoAt = $startAt->addDays($day - $dayOfWeek);
        }else{
            $this->toDoAt = $startAt->addDays(6 - $dayOfWeek + $day + 1);
        }
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
                $this->toDoAt
            );
            $this->toDoAt = $this->toDoAt->addDays(7);
            $count++;
        }while($count < $this->count);
        return $this->frequencies;
    }
}
