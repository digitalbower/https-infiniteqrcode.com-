<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        $user = User::where('username',Auth::user()->username)->orWhere('email',Auth::user()->username)->first();

        return view('profile',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
