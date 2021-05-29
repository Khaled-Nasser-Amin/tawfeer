<?php

namespace App\Http\Livewire\Front\Auth;

use App\Models\Vendor;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Register extends Component
{
    use WithRateLimiting;
    public $name,$phone,$password,$password_confirmation,$code;


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
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["name"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            $this->dispatchBrowserEvent('danger', __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'));
            return ;
        }
        $data=$this->validation();
        $code=implode('',array_rand([0,1,2,3,4,5,6,7,8,9],6));
        send_sms('+2'.$this->phone,__('text.Your activation code is:')." ".$code);
        session()->put('data',$data);
        session()->put('code',$code);
        session()->put('time',time());
        session()->put('activeCodeField','');
        $this->dispatchBrowserEvent('success',__('text.Message has been sent successfully'));


    }

    public function resend(){
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["code"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'),"phone"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            $this->dispatchBrowserEvent('danger', __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'));
            return ;
        }
        $code=implode('',array_rand([0,1,2,3,4,5,6,7,8,9],6));
        send_sms('+2'.$this->phone,__('text.Your activation code is:')." ".$code);
        session()->put('code',$code);
        session()->put('activeCodeField','');
        session()->forget('time');
        session()->put('time',time());
        $this->dispatchBrowserEvent('success',__('text.Message has been sent successfully'));
        $this->dispatchBrowserEvent('refreshCode',session()->get('time'));
    }

    public function create(){
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["code"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'),"phone"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            $this->dispatchBrowserEvent('danger', __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'));
            return ;
        }
        if (session()->has('code') && $this->code == session()->get('code')){
            if (session()->has('time') && time() < (session()->get('time')+(5*60)) ){
                if (session()->has('data')){
                    $data=session()->pull('data');
                    $vendor=Vendor::create([
                        'name' =>  $data['name'],
                        'phone' => $data['phone'],
                        'password' => bcrypt($data['password']),
                    ]);
                    Auth::guard('vendor')->login($vendor);
                    $this->dispatchBrowserEvent('success',__('text.Your account activated successfully'));
                    $this->redirect('/');
                }

            }else{
                $this->dispatchBrowserEvent('danger',__('text.CODE EXPIRED,please resend the activation code or cancel the operation.'));
            }
        }else{
            $this->dispatchBrowserEvent('danger',__('text.Invalid Code!'));
        }
    }

    public function cancel(){
        session()->forget('data');
        session()->forget('code');
        session()->forget('time');
        session()->forget('activeCodeField');
    }


    public function render()
    {
        return view('components.front.Auth.register');
    }
}
