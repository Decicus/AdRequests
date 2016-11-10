<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comment.
     *
     * @param  App\User  $user
     * @param  App\Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        return $user->admin || $user->helper;
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin || $user->helper;
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  App\User  $user
     * @param  App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
