<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits_between:6,15',
            'countrycode' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);

        // Save to database
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_code' => $request->countrycode,
            'message' => $request->message,
        ]);

        // Send email notification
        Mail::to("info@infiniteqrcode.com")->send(new ContactMessageMail($contact));

        return response()->json(['success' => true, 'message' => 'Enquiry Submitted Successfully']);
    }
}
