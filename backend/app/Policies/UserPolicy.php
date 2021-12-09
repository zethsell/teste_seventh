<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    use HandlesAuthorization;

    public function viewAny(User $user): Response

    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function view(User $user, User $model): Response
    {
        return (!$user->isAdmin() && $model->id !== $user->id)
            ? Response::deny()
            : Response::allow();
    }

    public function create(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function update(User $user, User $model): Response
    {
        return (!$user->isAdmin() && $model->id !== $user->id)
            ? Response::deny()
            : Response::allow();
    }

    public function delete(User $user, User $model): Response
    {
        return (!$user->isAdmin() && $model->id !== $user->id)
            ? Response::deny()
            : Response::allow();
    }

    public function changeLevel(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }
}
