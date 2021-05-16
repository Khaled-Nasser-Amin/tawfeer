<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest:vendor')->only(['loginView','registerView']);
    }
    public function logout(){
        auth()->guard('vendor')->logout();
        return redirect('/'.app()->getLocale());
    }
    public function loginView(){
        return view('front.Auth.login');
    }
    public function registerView(){
        return view('front.Auth.register');
    }
    public function forgetPassword(){
        return view('front.Auth.forget-password');
    }

}
