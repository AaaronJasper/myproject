<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use App\Models\User;
use Illuminate\Http\Request;


class SubscribedController extends Controller
{
    //使用觀察者模式發送email
    public function subscribe(){
        $user=User::find(auth()->id());
        $email=$user->email;
        //將登入者的email傳給event
        event(new UserSubscribed($email));
        return back();
    }
}
