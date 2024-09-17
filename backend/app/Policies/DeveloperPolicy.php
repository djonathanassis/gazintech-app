<?php

namespace App\Policies;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeveloperPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        
    }

    public function view(User $user, Developer $developer)
    {
    }

    public function create(User $user)
    {
    }

    public function update(User $user, Developer $developer)
    {
    }

    public function delete(User $user, Developer $developer)
    {
    }

    public function restore(User $user, Developer $developer)
    {
    }

    public function forceDelete(User $user, Developer $developer)
    {
    }
}
