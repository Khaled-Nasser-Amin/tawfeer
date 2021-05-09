<?php

namespace App\Http\Livewire\Front\Auth;

use Livewire\Component;

class Register extends Component
{

    public $name,$phone,$password,$password_confirmation;

    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|alpha_num|min:8|max:255',
            'password_confirmation' => 'required|alpha_num|min:8|max:255|',
        ]);
    }

    public function validation(){
      return  $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|alpha_num|min:8|max:255|confirmed',
            'password_confirmation' => 'required|string|max:255|',
        ]);
    }
    public function store(){
        $data=$this->validation();
        session()->put('data',$data);
        $code=implode('',array_rand([0,1,2,3,4,5,6,7,8,9],6));
        session()->put('code',$code);
        session()->put('activeCodeField','');
    }


    public function render()
    {
        return view('components.front.Auth.register');
    }
}
