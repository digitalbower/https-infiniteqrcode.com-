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

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',Rule::unique('users')->whereNull('deleted_at')], // Ignore soft deleted records,
            'password' => 'required|string|min:6|confirmed',
            'phonenumber' => 'required|numeric',
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


        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create([
            'email' => $user->email,
            'name' => $user->name,
        ]);

        $user->stripe_customer_id = $customer->id;
        $user->save();

        Auth::login($user); 

        // Send Welcome Email asynchronously
        Mail::to($user->email)->send(new WelcomeMail($user));

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
    
            // Check if subscription has ended or ends today
            $subscriptionEnded = $user->subscription_end && Carbon::parse($user->subscription_end)->isPast();
            Session::put('firstname', Auth::user()->firstname);
            Session::put('lastname', Auth::user()->lastname);
            $isNewUser = Auth::user()->subscription_end === null;
            if (isset($user->payment_failed_at) || $subscriptionEnded) {
                session(['showPaymentPopup' => true]); // Persistent session key
                return redirect()->route('upgrade')->with('success', 'Logged in successfully!');
            }
           
            else{
               return redirect()->route('profile')->with('success', 'Logged in successfully!');
            }
            
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