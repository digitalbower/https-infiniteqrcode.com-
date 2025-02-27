<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function updateProfilePicture(Request $request)
    {
        // Validate the request
        $request->validate([
            'croppedImage' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        if ($request->hasFile('croppedImage')) { 
            if ( $user->propic && Storage::disk('public')->exists( $user->propic)) {  
                Storage::disk('public')->delete( $user->propic);
            }
            $file = $request->file('croppedImage');  
            $fileName = 'profile_' . time() . '.png'; // Ensure it's saved as a PNG
            $filePath = $file->storeAs('profiles', $fileName, 'public');

            User::where('id', $user->id)->update(['propic' => $filePath]);
           
            return response()->json(['success' => true, 'imagePath' => asset('storage/' . $filePath) ]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload image']);
    }
}
