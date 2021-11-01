<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'format',
        'value',
        'total',
        'reported',
        'coefficient'
    ];
    public function scopeWeek($query, $start){
        $current = clone $start;
        $days = [];
        $dayCount = 0;
        do{
            $days[] = $current->format('Y-m-d');
            $current = $current->addDays();
            $dayCount++;
        }while($dayCount < 7);
        $order = join(', ', $days);
        $result =  $query->whereIn('value', $days)->where('format', 'day')->orderByRaw("FIELD (`value`, $order) ASC")->get();
        $collection = new Collection();
        foreach($days as $day){
            $find = $result->where('value', $day);
            if($find->count()){
                $collection->add($find->first());
            }else{
                $new = new Report([
                    'user_id' => auth()->id(),
                    'format' => 'day',
                    'value' => $day,
                    'total' => 0,
                    'reported' => 0,
                    'coefficient' => 0,
                ]);
                $collection->add($new);
            }
        }
        return $collection;
    }
    public function scopeMonth($query, $start, $last){
        $current = clone $start;
        $days = [];
        do{
            $days[] = $current->format('Y-m-d');
            $current = $current->addDays();
        }while($current->getTimestamp() < $last->getTimestamp());
        $order = join(', ', $days);
        $result = $query->whereIn('value', $days)->where('format', 'day')->orderByRaw("FIELD (`value`, $order) ASC")->get();
        $collection = new Collection();
        foreach($days as $day){
            $find = $result->where('value', $day);
            if($find->count()){
                $collection->add($find->first());
            }else{
                $new = new Report([
                    'user_id' => auth()->id(),
                    'format' => 'day',
                    'value' => $day,
                    'total' => 0,
                    'reported' => 0,
                    'coefficient' => 0,
                ]);
                $collection->add($new);
            }
        }
        return $collection;
    }
    public function scopeYear($query, $year){
        $months = [];
        for($i = 1; $i <= 12; $i++){
            $months[] = $year . '-' . ($i<10 ? '0' : '') . $i;
        }
        $order = join(', ', $months);
        $result = $query->whereIn('value', $months)->where('format', 'month')->orderByRaw("FIELD (`value`, $order) ASC")->get();
        $collection = new Collection();
        foreach($months as $month){
            $find = $result->where('value', $month);
            if($find->count()){
                $collection->add($find->first());
            }else{
                $new = new Report([
                    'user_id' => auth()->id(),
                    'format' => 'month',
                    'value' => $month,
                    'total' => 0,
                    'reported' => 0,
                    'coefficient' => 0,
                ]);
                $collection->add($new);
            }
        }
        return $collection;
    }
    public function getRelationValue($key)
    {
        return $this->coefficient ? $this->reported / $this->coefficient : 0;
    }
}
