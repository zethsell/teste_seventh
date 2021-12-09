<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AccessLogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function view(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function create(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function update(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

    public function delete(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny();
    }

}
