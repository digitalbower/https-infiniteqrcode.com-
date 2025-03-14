<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $subscriptionEnded = $user->subscription_end && Carbon::parse($user->subscription_end)->endOfDay()->isPast();
            $trialEnded = $user->plan === 'free' && now()->greaterThanOrEqualTo($user->created_at->addDays(8)->startOfDay());

            if ($user->payment_failed_at || $subscriptionEnded || $trialEnded) {
                
                if ($subscriptionEnded || $user->payment_failed_at ) {
                    Session::put('showPaymentPopup', true);
                    return redirect()->route('upgrade')->with('error', 'Your subscription has ended.');
                }

                if ($trialEnded) {
                    return redirect()->route('subscription')->with('info', 'Your free trial has ended. Please subscribe.');
                }
            }
        }

        return $next($request);
    }
}
