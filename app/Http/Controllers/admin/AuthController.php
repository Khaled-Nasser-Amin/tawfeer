<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout','activeAccount','saveFile']);
    }
    public function index(){
        return view('admin.auth.login');
    }

    public function logout(){
        auth()->logout();
        return view('admin.auth.logout');
    }

    //login
    public function login(Request $request){
        $password=$request->password;
        $email=$request->email;
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $cred=[
            'email'=>$email,
            'password'=>$password
        ];

        $user=User::where('email',$request->email)->firstOrFail();

        if (Hash::check($request->password,$user->password) && $user->two_factor_secret != null && $user->two_factor_recovery_codes != null){
            $request->session()->put([
                'login.id' => $user->getKey(),
                'login.remember' => $request->filled('remember'),
            ]);
            return view('admin.auth.two-factor-challenge');
        }else{
            if(Auth::guard('web')->attempt($cred,$request->remember_me ? 1 : 0))
            {
                return redirect(RouteServiceProvider::HOME);
            }else{
                session()->flash('_old_input');
                session()->put('_old_input._token',csrf_token());
                session()->put('_old_input.email',$email);
                return redirect()->back()->withErrors(['email'=>__('text.This password does not match our records.')]);
            }
        }


    }



    //forget password
    public function viewForget(){
        return view('admin.auth.forgetPassword');
    }

    public function messageAfterSendingEmailToResetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users'
        ]);
        $key=Str::random();
        $email=$request->email;
        session()->put('email',$email);
        session()->put('key',$key);

        Mail::to($email)->send(new ResetPasswordEmail(route('viewResetPassword',$request->_token.$key)));
        return view('emails.messageAfterSendingEmail');
    }

    public function viewResetPassword(Request $request,$token){
        if(session()->has('_token') && session()->has('key') && session()->get('_token').session()->get('key') == $token){
            return view('admin.auth.reset-password');
        }
        else{
            return abort(404);
        }
    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|alpha_num|max:255|confirmed'
        ]);
        if (session()->has('email')){
            $user=User::where('email',session()->get('email'))->first();
            $password=bcrypt($request->password);
            $user->update(['password' => $password]);
            $user->save();
            session()->forget('email');
            auth()->login($user);
            return redirect('/');
        }else{
            return abort(404);
        }
    }

}
