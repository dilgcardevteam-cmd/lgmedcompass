<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $authUser): bool
    {
        return in_array($authUser->role, ['Admin', 'Technical Inspector']);
    }

    public function view(User $authUser, User $user): bool
    {
        return in_array($authUser->role, ['Admin', 'Technical Inspector']);
    }

    public function create(User $authUser): bool
    {
        return $authUser->role === 'Admin';
    }

    public function update(User $authUser, User $user): bool
    {
        return $authUser->role === 'Admin';
    }

    public function delete(User $authUser, User $user): bool
    {
        return $authUser->role === 'Admin';
    }

    public function restore(User $authUser, User $user): bool
    {
        return $authUser->role === 'Admin';
    }

    public function forceDelete(User $authUser, User $user): bool
    {
        return $authUser->role === 'Admin';
    }
}
