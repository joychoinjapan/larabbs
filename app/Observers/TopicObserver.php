<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $topic->excerpt = make_excerpt($topic->body);
        if(! $topic->slug){
            $result = app(SlugTranslateHandler::class)->translate($topic->title);

            if(!is_array($result)){
                $result=json_decode($result,true);
            }

            if(array_key_exists('code',$result)&&400==$result['code']){
                session()->flash('danger',$result['message']);
                return back();
            }

            if(array_key_exists('text',$result)){
                $topic->slug = str_replace(' ','-',$result['text']);
            }
        }
    }
}
