<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function subscription(){
        Session::put('firstname', Auth::user()->firstname);
        Session::put('lastname', Auth::user()->lastname);

        $id = Auth::user()->id;
        $plans = User::leftJoin('user_subscriptions','user_subscriptions.user_id' ,'=','users.id')->where('users.id',$id)->first();
     
        $subscribe = "";
        return view('subscription')->with(['plans'=>$plans,'subscribe'=>$subscribe]);
    }

    public function upgrade()
    {
        $id = Auth::user()->id;
        $plans = User::find($id);
        return view('upgrade')->with(['plans'=>$plans]);
    }
}
