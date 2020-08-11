<?php
namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{
    //次の画像だけアップロードできる
    protected  $allowed_ext = ["png","jpg","gif","jpeg"];

    public function save($file,$folder,$file_prefix)
    {
        //directoryの規則を構築:uploads/images/avatars/201709/21
        $folder_name = "uploads/images/$folder/".date("Ymd",time());

        //サーバーで保存するdirectory
        //例えば：/home/vagrant/code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path=public_path().'/'.$folder_name;

        //拡張子取得
        $extension = strtolower($file->getClientOriginalExtension())?:'png';

        //file名を作成
        $filename = $file_prefix . '_' .time().'_'.Str::random(10).'.'.$extension;

        //アップされた物は画像でなければ、アップロードを中止させる
        if(! in_array($extension,$this->allowed_ext)){
            return false;
        }

        $file->move($upload_path,$filename);

        return [
            'path' =>config('app.url')."/$folder_name/$filename"
        ];

    }
}
