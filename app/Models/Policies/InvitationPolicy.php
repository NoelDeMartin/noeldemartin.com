<?php

namespace App\Models\Policies;

use App\Models\Invitation;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any invitations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can view the invitation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function view(User $user, Invitation $invitation)
    {
        return $user->is_admin;
    }
}
