<?php

namespace App\Models\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Morilog\Jalali\Jalalian;

class Monthly extends Task
{
    private Carbon $toDoAt;
    public function __construct(
        private String $title,
        private Carbon $startAt,
        private bool $qualitative = false,
        private int $coefficient = 1,
        private int $count,
        private int | String $day,
    ){
        $this->frequencies = new Collection();
        if(!is_int($day)){
            if(ctype_digit($day)){
                $this->day = $day = (int) $day;
            }elseif($day == 'last_day'){
                $this->day = $day = 0;
            }elseif($day == 'before_last'){
                $this->day = $day = -1;
            }
        }
        $this->toDoAt = $this->findDay($startAt);
        $this->frequencies();
    }

    private function findDay(Carbon $from): Carbon
    {
        $jalali = Jalalian::fromCarbon($from);
        $current = $jalali->getDay();
        switch($this->day){
            case 0: $day = $jalali->getMonthDays(); break;
            case -1: $day = $jalali->getMonthDays() -1 ; break;
            default: $day = $this->day;
        }
        if($jalali->getMonthDays() < $day){
            return $this->findDay($this->nextDay($from));
        }
        if($current == $day){
            return $from;
        }elseif($current < $day){
            return $this->findDay($jalali->addDays($day - $current)->toCarbon());
        }elseif($current > $day){
            return $this->findDay($this->nextDay($from));
        }
    }

    private function nextDay(Carbon $day): Carbon
    {
        $jalali = Jalalian::fromCarbon($day);
        return (new Jalalian($jalali->getYear(), $jalali->getMonth(), 1))->addMonths()->toCarbon();
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
            $this->toDoAt = $this->findDay($this->nextDay($this->toDoAt));
            $count++;
        }while($count < $this->count);
        return $this->frequencies;
    }
}
