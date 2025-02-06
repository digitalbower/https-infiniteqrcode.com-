<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phonenumber' => 'required|numeric'
       ]);
        $user = new User();
        $user->firstname= $request->firstname;
        $user->lastname= $request->lastname;
        $user->email= $request->email;
        $user->username= $request->email;
        $user->password= Hash::make($request->password);
        $user->countrycode= $request->countrycode;
        $user->phonenumber= $request->phonenumber;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }

    // Sign In
    public function login(Request $request)
    { 
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($fields)) { 
            return redirect()->route('profile')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin')->with('success', 'Logged out successfully');
    }

}