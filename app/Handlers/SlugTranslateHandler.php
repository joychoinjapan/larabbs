<?php
namespace App\Handlers;
use Google\Cloud\Translate\V2\TranslateClient;

class SlugTranslateHandler
{
    private $api_key = '';
    public function __construct()
    {
        $this->api_key = env('GOOGLE_TRANSLATION_API_KEY');
    }

    public function translate($text)
    {
        try{
        $targetLanguage = 'en';
        $translate = new TranslateClient(['key'=>$this->api_key]);

        $result = $translate->translate($text,[
           'target' => $targetLanguage
        ]);
        return $result;
        } catch (\Exception $e){
            $array = [
                'code'=> 400 ,
                'message'=>'API通信には問題が発生しています'
            ];
            return json_encode($array,JSON_UNESCAPED_UNICODE);
        }
    }
}
