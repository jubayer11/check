<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\User;
use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function  index($id){
        $user=User::find($id);
        return [
            'read' =>NotificationResource::collection($user->readNotifications),
            'unread' => NotificationResource::collection($user->unReadNotifications),
        ];
    }

    public function markAsRead(Request $request,$id){
        $user=User::find($id);
        $user->notifications->where('id',$request->id)->markAsRead();

    }

}
