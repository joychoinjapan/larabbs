<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * ユーザー本人が更新可能か決める
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function update(User $currentUser,User $user)
    {
        return $currentUser->id === $user->id;
    }
}
