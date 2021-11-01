<?php

namespace App\Models;

use App\Models\Task\Builder;
use App\Models\Task\Task as TaskInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'qualitative',
        'coefficient',
        'score',
        'todo_at',
        'reported_at',
        'frequency_type'
    ];

    protected $casts = [
        'todo_at' => 'datetime',
        'reported_at' => 'datetime'
    ];

    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->user_id = auth()->id();
        });
    }

    public static function build(array $data): TaskInterface
    {
        return Builder::build($data);
    }

    public function getJalaliTodoAtAttribute(){
        return Jalalian::fromCarbon($this->todo_at);
    }
    public function getJalaliReportedAtAttribute(){
        if(!$this->attributes['reported_at']) return null;
        return Jalalian::fromCarbon($this->reported_at);
    }

    public function getRelationValue($key)
    {
        return $this->score / $this->coefficient;
    }
}
