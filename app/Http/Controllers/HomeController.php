<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function createqrcode()
    {
        return view('createqrcode'); 
    }

    public function url()
    {
        return view('url'); 
    }
    public function video()
    {
        return view('video'); 
    }
    public function wifi()
    {
        return view('wifi'); 
    }
    public function vcard()
    {
        return view('vcard'); 
    }
    public function sms()
    {
        return view('sms'); 
    }
    public function email()
    {
        return view('email'); 
    }
    public function image()
    {
        return view('image'); 
    }
    public function pdf()
    {
        return view('pdf');
    }
    public function bitcoin()
    {
        return view('bitcoin');
    }
    public function mp3()
    {
        return view('mp3'); 
    }
    public function appstore()
    {
        return view('appstore'); 
    }
    public function socialmedia()
    {
        return view('socialmedia');
    }
    public function analytics()
    {
        return view('analytics');
    }
    public function myqrcode()
    {
        return view('my-qr-code');
    }
    public function upgrade()
    {
        return view('upgrade');
    }
    public function plandetails()
    {
        return view('plandetails');
    }

    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        return view('index');
    }
}
