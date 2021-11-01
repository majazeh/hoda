<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;
    public function create(User $user, Task $task){
        return $task->user_id == $user->id;
    }
}
