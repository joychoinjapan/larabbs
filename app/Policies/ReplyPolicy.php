<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
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

    //トピックの作者またはコメントの作者は削除できる
    public function delete(User $user,Reply $reply)
    {
        return $user->isAuthorOf($reply)||$user->isAuthorOf($reply->topic());
    }
}
