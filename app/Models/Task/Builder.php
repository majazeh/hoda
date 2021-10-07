<?php

namespace App\Models\Task;

use Carbon\Carbon;

class Builder
{
    public static function build(array $data): Task
    {
        $title = $data['title'];
        $startAt = Carbon::createFromTimestamp($data['start_at'])->startOfDay();
        $qualitative = isset($data['qualitative']) ? true : false;
        $type = $data['frequency_type'];
        $count = $data['frequency_count'];
        $coefficient = (int) $data['coefficient'];
        switch($data['frequency_type']){
            case 'daily' : return new Daily($title, $startAt, $qualitative, $coefficient, $count);
            case 'weekly' : return new Weekly($title, $startAt, $qualitative, $coefficient, $count, (int) $data['weekday']);
            case 'monthly' : return new Monthly($title, $startAt, $qualitative, $coefficient, $count, $data['month_day']);
        }
    }
}
