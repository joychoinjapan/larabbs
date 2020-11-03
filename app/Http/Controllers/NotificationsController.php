<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //ユーザーの通知をもらう
        $notifications =Auth::user()->notifications()->paginate(20);

        //既読とする
        Auth::user()->markAsRead();
        return view('notifications.index',compact('notifications'));

    }
}
