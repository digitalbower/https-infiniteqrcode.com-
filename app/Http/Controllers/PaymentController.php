<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;  


class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); // Set Stripe secret key

        // Validate request
        $request->validate([
            'plan' => 'required|string',
            'bprice' => 'required|numeric',
            'duration' => 'required|numeric',
            'stripeToken' => 'required|string', // Fix: Validate stripeToken properly
        ]); 

        try {
            // Charge the user
            $charge = Charge::create([
                'amount' => $request->bprice * 100, // Convert to cents
                'currency' => 'usd',
                'description' => $request->plan,
                'source' => $request->stripeToken, // Fix: Use the request token, not env()
            ]);

            // Check if charge object contains data
            if (!$charge || !isset($charge->id)) {
                return back()->withErrors(['error' => 'Payment failed. No charge ID returned.']);
            }

            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) { 
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    
    }

    public function success()
    {
        return view('success')->with('message', 'Payment successful! Thank you for subscribing.');
    }

    public function cancel()
    {
        return view('cancel')->with('message', 'Payment was canceled. Please try again.');
    }
}
