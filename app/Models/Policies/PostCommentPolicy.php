<?php

namespace App\Models\Policies;

use App\Models\PostComment;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any post comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the post comment.
     *
     * @param  \App\Models\User         $user
     * @param  \App\Models\PostComment  $comment
     * @return mixed
     */
    public function view(User $user, PostComment $comment)
    {
        return $user->is_admin;
    }
}
