<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Customer;
use Stripe\Stripe;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Rules\BlockDisposableEmail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => ['required','string',new BlockDisposableEmail(),'email','max:255',Rule::unique('users')->whereNull('deleted_at')], // Ignore soft deleted records,
            'password' => ['required','string','min:8','regex:/^[A-Z]/','regex:/\d/','regex:/[@$!%*?&]/','confirmed'],
            'phonenumber' => 'required|numeric',
            'terms'=>'required'
       ],[
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Password must start with a capital letter, and include at least one number and one special character.',
        'password.confirmed' => 'Passwords do not match.',
       ]);
        $user = new User();
        $user->firstname= $request->firstname;
        $user->lastname= $request->lastname;
        $user->email= $request->email;
        $user->username= $request->email;
        $user->password= Hash::make($request->password);
        $user->countrycode= $request->countrycode;
        $user->phonenumber= $request->phonenumber;
         $user->plan = 'free';
        $user->renew_status = 'Enabled';
        $user->subscribe_status = 'Active';
        $user->save();


          // Attempt Stripe customer creation
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $customer = Customer::create([
                'email' => $user->email,
                'name' => "{$user->firstname} {$user->lastname}",
            ]);

            $user->stripe_customer_id = $customer->id;
            $user->save();
        } catch (Exception $e) {
            // Log the Stripe error for debugging
            Log::error('Stripe Customer Creation Failed: ' . $e->getMessage());
        }


        Auth::login($user); 

        // Send Welcome Email asynchronously
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (Exception $e) {
            Log::error('Welcome Email Failed: ' . $e->getMessage());
        }

      return redirect()->route('profile')->with('success', 'Account created successfully!');
    }

    // Sign In
    public function login(Request $request)
    { 
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::attempt($fields)) { 
            $user = auth()->user();
    
            // Check subscription and trial statuses
            $subscriptionEnded = $user->subscription_end && Carbon::parse($user->subscription_end)->endOfDay()->isPast();
            $trialEnded = $user->created_at->addDays(8)->startOfDay()->isPast();
            $freeSubscriptionEnded = $user->plan === 'free' && $trialEnded;

            // Store user and plan details in session
            session([
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'plan' => $user->plan,
                'subscription_ended' => $subscriptionEnded,
                'free_subscription_ended' => $freeSubscriptionEnded,
                'payment_failed' => !is_null($user->payment_failed_at)
            ]);

            if ($user->payment_failed_at || $subscriptionEnded) { 
                session(['showPaymentPopup' => true]);
                return redirect()->route('upgrade')->with('error', 'Your subscription has ended.');
            }
            
            if ($freeSubscriptionEnded) { 
                return redirect()->route('subscription')->with('info', 'Your free trial has ended. Please subscribe.');
            }
    
            return redirect()->route('profile')->with('success', 'Logged in successfully!');
        } 
    
        return back()->with('error', 'Invalid credentials');
    }
    

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

}