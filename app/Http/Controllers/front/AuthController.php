<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView(){
        return view('front.auth.login');
    }
    public function registerView(){
        return view('front.auth.register');
    }

}
