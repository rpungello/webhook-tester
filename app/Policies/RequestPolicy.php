<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Request $request): bool
    {
        return $user->getKey() === $request->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Request $request): bool
    {
        return $user->getKey() === $request->user_id;
    }

    public function delete(User $user, Request $request): bool
    {
        return $this->update($user, $request);
    }

    public function restore(User $user, Request $request): bool
    {
        return $this->delete($user, $request);
    }

    public function forceDelete(User $user, Request $request): bool
    {
        return $this->delete($user, $request);
    }
}
