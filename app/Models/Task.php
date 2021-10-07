<?php

namespace App\Models;

use App\Models\Task\Builder;
use App\Models\Task\Task as TaskInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'todo_at' => 'datetime'
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
}
