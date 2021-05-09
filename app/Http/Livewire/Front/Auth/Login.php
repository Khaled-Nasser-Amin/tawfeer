<?php

namespace App\Http\Livewire\Front\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $phone,$password,$check;
    public function loginForm(){
        $this->validation();
        if (Auth::guard('vendor')->attempt(['phone' => $this->phone,'password'=>$this->password],$this->check == 'forever' ?1:0 )){
            return $this->redirect('/');
        }else{
            $this->setErrorBag(['phone'=>__('text.This credentials does not match our records.')]);
        }

    }
    public function validation(){
        return $this->validate([
            'phone' => 'required|numeric|exists:vendors,phone',
            'password' => 'required|alpha_num|min:5',
        ]);
    }
    public function render()
    {
        return view('components.front.Auth.login-form');
    }
}
