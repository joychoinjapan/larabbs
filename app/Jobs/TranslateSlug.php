<?php

namespace App\Jobs;

use App\Handlers\SlugTranslateHandler;
use GPBMetadata\Google\Api\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        // 队列任务构造器中接收了 Eloquent 模型，将会只序列化模型的 ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(! $this->topic->slug){
            $result = app(SlugTranslateHandler::class)->translate($this->topic->title);

            if(!is_array($result)){
                $result=json_decode($result,true);
            }

            if(array_key_exists('code',$result) && 400 == $result['code']){
                \Illuminate\Support\Facades\Log::debug($result);
            }

            if(array_key_exists('text',$result)) {
                $slug = str_replace(' ', '-', $result['text']);
                DB::table('topics')
                    ->where('id', $this->topic->id)->update(['slug' => $slug]);
            }
        }
    }
}
