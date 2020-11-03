<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $replyRequest,Reply $reply)
    {

        $reply->content = $replyRequest->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $replyRequest->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success','コメントを送信しました');

    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete',$reply);
        $reply->delete();

        return redirect()->to($reply->topic->link())->with('success','コメントを削除しました');;
    }
}
