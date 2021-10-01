<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\NotificationResource;

class NotifController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function index(){
        return [
            'read' => NotificationResource::collection(auth()->user()->readNotifications),
            'unRead' => NotificationResource::collection(auth()->user()->unReadNotifications),
        ];
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->notifications->where('id',$request->id)->markAsRead();
    }
}
