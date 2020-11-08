<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    public function created(Reply $reply)
    {
        if( ! app()->runningInConsole()){
            $reply->topic->reply_count=$reply->topic->replies->count();
            $reply->topic->save();
            $reply->topic->user->topicNotify(new TopicReplied($reply));
        }
    }
}
