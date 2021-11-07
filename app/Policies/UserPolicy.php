<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public function access(User $user){
        return $user->id == 1;
    }

    public function update(User $user, User $usr){
        return $user->id == 1 || $usr->id == $user->id;
    }
}
