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
        $countries = $this->getAllCountries();

        return view('profile',['user'=>$user,'countries'=>$countries]);
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
    public function getAllCountries(){

        $countries = [
            ["name" => "Afghanistan", "dial_code" => "+93"],
            ["name" => "Albania", "dial_code" => "+355"],
            ["name" => "Algeria", "dial_code" => "+213"],
            ["name" => "Andorra", "dial_code" => "+376"],
            ["name" => "Angola", "dial_code" => "+244"],
            ["name" => "Antigua and Barbuda", "dial_code" => "+1-268"],
            ["name" => "Argentina", "dial_code" => "+54"],
            ["name" => "Armenia", "dial_code" => "+374"],
            ["name" => "Australia", "dial_code" => "+61"],
            ["name" => "Austria", "dial_code" => "+43"],
            ["name" => "Azerbaijan", "dial_code" => "+994"],
            ["name" => "Bahamas", "dial_code" => "+1-242"],
            ["name" => "Bahrain", "dial_code" => "+973"],
            ["name" => "Bangladesh", "dial_code" => "+880"],
            ["name" => "Barbados", "dial_code" => "+1-246"],
            ["name" => "Belarus", "dial_code" => "+375"],
            ["name" => "Belgium", "dial_code" => "+32"],
            ["name" => "Belize", "dial_code" => "+501"],
            ["name" => "Benin", "dial_code" => "+229"],
            ["name" => "Bhutan", "dial_code" => "+975"],
            ["name" => "Bolivia", "dial_code" => "+591"],
            ["name" => "Bosnia and Herzegovina", "dial_code" => "+387"],
            ["name" => "Botswana", "dial_code" => "+267"],
            ["name" => "Brazil", "dial_code" => "+55"],
            ["name" => "Brunei", "dial_code" => "+673"],
            ["name" => "Bulgaria", "dial_code" => "+359"],
            ["name" => "Burkina Faso", "dial_code" => "+226"],
            ["name" => "Burundi", "dial_code" => "+257"],
            ["name" => "Cambodia", "dial_code" => "+855"],
            ["name" => "Cameroon", "dial_code" => "+237"],
            ["name" => "Canada", "dial_code" => "+1"],
            ["name" => "Central African Republic", "dial_code" => "+236"],
            ["name" => "Chad", "dial_code" => "+235"],
            ["name" => "Chile", "dial_code" => "+56"],
            ["name" => "China", "dial_code" => "+86"],
            ["name" => "Colombia", "dial_code" => "+57"],
            ["name" => "Comoros", "dial_code" => "+269"],
            ["name" => "Congo", "dial_code" => "+242"],
            ["name" => "Costa Rica", "dial_code" => "+506"],
            ["name" => "Croatia", "dial_code" => "+385"],
            ["name" => "Cuba", "dial_code" => "+53"],
            ["name" => "Cyprus", "dial_code" => "+357"],
            ["name" => "Czech Republic", "dial_code" => "+420"],
            ["name" => "Denmark", "dial_code" => "+45"],
            ["name" => "Djibouti", "dial_code" => "+253"],
            ["name" => "Dominican Republic", "dial_code" => "+1-809"],
            ["name" => "Ecuador", "dial_code" => "+593"],
            ["name" => "Egypt", "dial_code" => "+20"],
            ["name" => "El Salvador", "dial_code" => "+503"],
            ["name" => "Estonia", "dial_code" => "+372"],
            ["name" => "Ethiopia", "dial_code" => "+251"],
            ["name" => "Fiji", "dial_code" => "+679"],
            ["name" => "Finland", "dial_code" => "+358"],
            ["name" => "France", "dial_code" => "+33"],
            ["name" => "Gabon", "dial_code" => "+241"],
            ["name" => "Gambia", "dial_code" => "+220"],
            ["name" => "Georgia", "dial_code" => "+995"],
            ["name" => "Germany", "dial_code" => "+49"],
            ["name" => "Ghana", "dial_code" => "+233"],
            ["name" => "Greece", "dial_code" => "+30"],
            ["name" => "Guatemala", "dial_code" => "+502"],
            ["name" => "Honduras", "dial_code" => "+504"],
            ["name" => "Hungary", "dial_code" => "+36"],
            ["name" => "Iceland", "dial_code" => "+354"],
            ["name" => "India", "dial_code" => "+91"],
            ["name" => "Indonesia", "dial_code" => "+62"],
            ["name" => "Iran", "dial_code" => "+98"],
            ["name" => "Iraq", "dial_code" => "+964"],
            ["name" => "Ireland", "dial_code" => "+353"],
            ["name" => "Israel", "dial_code" => "+972"],
            ["name" => "Italy", "dial_code" => "+39"],
            ["name" => "Jamaica", "dial_code" => "+1-876"],
            ["name" => "Japan", "dial_code" => "+81"],
            ["name" => "Jordan", "dial_code" => "+962"],
            ["name" => "Kazakhstan", "dial_code" => "+7"],
            ["name" => "Kenya", "dial_code" => "+254"],
            ["name" => "Kuwait", "dial_code" => "+965"],
            ["name" => "Lebanon", "dial_code" => "+961"],
            ["name" => "Malaysia", "dial_code" => "+60"],
            ["name" => "Maldives", "dial_code" => "+960"],
            ["name" => "Mexico", "dial_code" => "+52"],
            ["name" => "Morocco", "dial_code" => "+212"],
            ["name" => "Nepal", "dial_code" => "+977"],
            ["name" => "Netherlands", "dial_code" => "+31"],
            ["name" => "New Zealand", "dial_code" => "+64"],
            ["name" => "Nigeria", "dial_code" => "+234"],
            ["name" => "North Korea", "dial_code" => "+850"],
            ["name" => "Norway", "dial_code" => "+47"],
            ["name" => "Oman", "dial_code" => "+968"],
            ["name" => "Pakistan", "dial_code" => "+92"],
            ["name" => "Palestine", "dial_code" => "+970"],
            ["name" => "Panama", "dial_code" => "+507"],
            ["name" => "Paraguay", "dial_code" => "+595"],
            ["name" => "Peru", "dial_code" => "+51"],
            ["name" => "Philippines", "dial_code" => "+63"],
            ["name" => "Poland", "dial_code" => "+48"],
            ["name" => "Portugal", "dial_code" => "+351"],
            ["name" => "Qatar", "dial_code" => "+974"],
            ["name" => "Romania", "dial_code" => "+40"],
            ["name" => "Russia", "dial_code" => "+7"],
            ["name" => "Saudi Arabia", "dial_code" => "+966"],
            ["name" => "Singapore", "dial_code" => "+65"],
            ["name" => "South Africa", "dial_code" => "+27"],
            ["name" => "Spain", "dial_code" => "+34"],
            ["name" => "Sri Lanka", "dial_code" => "+94"],
            ["name" => "Sweden", "dial_code" => "+46"],
            ["name" => "Switzerland", "dial_code" => "+41"],
            ["name" => "Thailand", "dial_code" => "+66"],
            ["name" => "Turkey", "dial_code" => "+90"],
            ["name" => "United Arab Emirates", "dial_code" => "+971"],
            ["name" => "United Kingdom", "dial_code" => "+44"],
            ["name" => "United States", "dial_code" => "+1"],
            ["name" => "Venezuela", "dial_code" => "+58"],
            ["name" => "Vietnam", "dial_code" => "+84"]
        ];
        
    
        return $countries;
    
    }
    
}
