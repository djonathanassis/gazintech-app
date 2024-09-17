<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Level;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LevelPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Level $level)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Level $level)
    {
        return true;
    }

    public function delete(User $user, Level $level)
    {
        return true;
    }

    public function restore(User $user, Level $level)
    {
        return true;
    }

    public function forceDelete(User $user, Level $level)
    {
        return true;
    }
}
