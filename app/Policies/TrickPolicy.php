<?php

namespace App\Policies;

use App\Models\Trick;
use App\Models\User;

class TrickPolicy
{
    public function create(User $user): bool
    {
        // user is verified
        return true;
    }

    public function update(User $user, Trick $trick): bool
    {
        return $user->id === $trick->id;
    }

    public function delete(User $user, Trick $trick): bool
    {
        return $user->id === $trick->id;
    }
}
