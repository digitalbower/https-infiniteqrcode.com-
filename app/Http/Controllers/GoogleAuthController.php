<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use App\Mail\WelcomeMail;
use Stripe\Stripe;
use Illuminate\Support\Facades\Mail;



class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
   


    public function handleGoogleCallback()
    {
        try {
        Log::info('Starting Google Sign-In process.');

        $googleUser = Socialite::driver('google')->user();
        Log::info('Received user from Google', ['email' => $googleUser->getEmail()]);

        // Check if user exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            Log::info('User does not exist, creating new user...');
            $user = User::create([
                'firstname' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'username' => Str::slug($googleUser->getName()) . rand(1000, 9999),
                'password' => bcrypt('google-auth'),
                'plan' => 'free',
                'renew_status' => 'Enabled',
                'subscribe_status' => 'Active',
                'countrycode' => '+91' // Provide a default if needed
            ]);

            Log::info('User created successfully', ['id' => $user->id]);
        } else {
            Log::info('User already exists, skipping creation.', ['id' => $user->id]);
        }

        // ✅ Create Stripe customer only if it doesn't exist
        if (!$user->stripe_customer_id) {
            Log::info('Creating Stripe customer...');
            Stripe::setApiKey(config('services.stripe.secret'));

            $customer = Customer::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
            ]);

            $user->stripe_customer_id = $customer->id;
            $user->save();
            Log::info('Stripe customer created successfully', ['stripe_id' => $customer->id]);
        }

        // ✅ Log in the user
        Auth::login($user);
        Log::info('User logged in successfully.', ['id' => $user->id]);

        // ✅ Send Welcome Email (Use queue for better performance)
        Mail::to($user->email)->queue(new WelcomeMail($user));
        Log::info('Welcome email queued successfully.');

        return redirect()->route('profile');

    } catch (\Exception $e) {
        // ✅ Log detailed error information
        Log::error('Google Sign-In Error: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        // ✅ Display error message on login page
        return redirect()->route('login')->with('error', 'Google Sign-In failed: ' . $e->getMessage());
    }
    }
}
