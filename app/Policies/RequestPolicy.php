<?php

namespace App\Policies;

use App\User;
use App\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the request.
     *
     * @param  App\User  $user
     * @param  App\Request  $request
     * @return mixed
     */
    public function view(User $user, Request $request)
    {
        return $user->admin || $request->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the request.
     *
     * @param  App\User  $user
     * @param  App\Request  $request
     * @return mixed
     */
    public function update(User $user, Request $request)
    {
        return $user->admin || $request->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the request.
     *
     * @param  App\User  $user
     * @param  App\Request  $request
     * @return mixed
     */
    public function delete(User $user, Request $request)
    {
        return $user->admin;
    }
}
