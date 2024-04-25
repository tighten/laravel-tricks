<?php

namespace App\Policies;

use App\Models\Trick;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrickPolicy
{
    public function update(User $user, Trick $trick): bool
    {
        return $user->id === $trick->id;
    }
}
