<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * View profile
     */
    public function edit()
    {
        $user = User::where('username',Auth::user()->username)->orWhere('email',Auth::user()->username)->first();

        return view('profile',['user'=>$user]);
    }

    /**
     * Update profile.
     */
    public function update(Request $request, string $id)
    {
        $v = Validator::make($request->all(),[
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,'.$id,
            'phonenumber' => 'required|numeric'
        ]);
        if ($v->fails()) {
            return response()->json([
                'message' => $v->errors()
            ]);
        }    
        $user = User::find($id);
        $user->firstname= $request->firstname;
        $user->lastname= $request->lastname;
        $user->email= $request->email;
        $user->countrycode= $request->countrycode;
        $user->phonenumber= $request->phonenumber;
        $user->companyname = $request->companyname;
        $user->countryname = $request->countryname;
        $user->save();
        
        return response()->json([
            "status" => "success",
            "user"  => $user
        ]);
    }
     /**
     * Password reset.
     */
    public function password_reset(Request $request){
        $id = Auth::user()->id; 
        $user = User::find($id);
        $user->password= $request->password;
        $user->save();
        
        return response()->json([
            "message" => "success"
        ]);
    }
    /**
     * Delete account
     */
    public function delete_account(Request $request)
    {   
        if($request->data == "delete"){
            $id = Auth::user()->id; 
            $user = User::find($id);
            $user->delete();

            $request->session()->invalidate();

            return response()->json([
                "message" => "success"
            ]);
        }
        
        
    }
}
