<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\DisablePaymentMail;
use App\Mail\RenewSubscriptionMail;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function subscription(){
        Session::put('firstname', Auth::user()->firstname);
        Session::put('lastname', Auth::user()->lastname);

        $id = Auth::user()->id;
        $plans = User::leftJoin('user_subscriptions','user_subscriptions.user_id' ,'=','users.id')->where('users.id',$id)->first();
     
        $subscribe = $plans->subscribe_status; 
        $renew_status = $plans->renew_status;
        return view('subscription')->with(['plans'=>$plans,'subscribe'=>$subscribe,'renew_status'=>$renew_status]);
    }

    public function upgrade()
    {
        $id = Auth::user()->id;
        $plans = User::find($id);
        return view('upgrade')->with(['plans'=>$plans]);
    }
    public function renewSubscription(Request $request){
    
        // Ensure user is authenticated
        $id = Auth::user()->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Validate the request
        $request->validate([
            'canceltype' => 'required|in:Enabled,disabled,cancel,Reactivate',
        ]);
        DB::transaction(function () use ($user, $request) {
            switch ($request->canceltype) {
                case 'Enabled':
                    if ($user->renew_status == 'disabled') {
                        $user->update(['renew_status' => 'Enabled']);
                        $this->sendMail($user, "Automatic Payment Turned On", 'emails.enable');
                    }
                    break;

                case 'disabled':
                    if ($user->renew_status == 'Enabled') {
                        $user->update(['renew_status' => 'disabled']);
                        $this->sendMail($user, "Automatic Payment Turned Off", 'emails.disable');
                    }
                    break;

                case 'cancel':
                    if ($user->subscribe_status == 'Active') {
                        $user->update(['renew_status' => 'disabled', 'subscribe_status' => 'Inactive']);
                        $this->sendMail($user, "Subscription Cancellation Request", 'emails.cancel');
                    }
                    break;

                case 'Reactivate':
                    if ($user->subscribe_status == 'Inactive') {
                        $user->update(['renew_status' => 'Enabled', 'subscribe_status' => 'Active']);
                        $this->sendMail($user, "Subscription Reactivate Request", 'emails.reactivate');
                    }
                    break;
            }
        });
        return response()->json(['success' => true]);
    }
    private function sendMail($user, $subject, $view)
    {
        Mail::to($user->email)->send(new RenewSubscriptionMail($user, $subject, $view));
    }
}
