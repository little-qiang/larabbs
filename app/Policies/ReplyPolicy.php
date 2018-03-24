<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use App\Models\Topic;

class ReplyPolicy extends Policy
{
    public function destroy(User $user, Reply $reply, Topic $topic)
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($topic);
    }
}