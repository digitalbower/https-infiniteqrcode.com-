<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function upgrade()
    {
        $id = Auth::user()->id;
        $plans = User::find($id);
        return view('upgrade')->with(['plans'=>$plans]);
    }
}
