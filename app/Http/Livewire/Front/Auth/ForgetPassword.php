<?php

namespace App\Http\Livewire\Front\Auth;

use App\Models\Vendor;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForgetPassword extends Component
{
    use WithRateLimiting;
    public $phone,$code,$password,$password_confirmation;

    public function sendSMS(){

        try {
            $this->rateLimit(10);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["phone"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            return ;
        }
        $data=$this->validate([
            'phone' => 'required|exists:vendors|numeric'
        ]);

        session()->put('phone',$data['phone']);
        $this->resend();

    }

    public function activeSetNewPassword(){
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["code"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'),"phone"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            return ;
        }
        if (session()->has('time') && time() < (session()->get('time')+(5*60)) ){
            if(session()->has('code') && session()->get('code') == $this->code){
                if(session()->has('phone')){
                   session()->put('activeSetNewPassword','');
                   $this->cancel();
                   $this->code=null;
                }
            }else{
                $this->setErrorBag(['code'=>__('text.Invalid Code!')]);
                $this->dispatchBrowserEvent('danger',__('text.Invalid Code!'));
            }
        }else{
            $this->setErrorBag(['code'=>__('text.CODE EXPIRED,please resend the activation code or cancel the operation.')]);
            $this->dispatchBrowserEvent('danger',__('text.CODE EXPIRED,please resend the activation code or cancel the operation.'));
        }
    }

    public function updatePassword(){
        $data=$this->validate([
            'password' => 'required|alpha_num|min:8|max:255|confirmed',
            'password_confirmation' => 'required|string|min:8|max:255|',
        ]);
        $phone=session()->pull('phone');
        $user=Vendor::where('phone',$phone)->first();
        $user->update([
            'password' =>bcrypt($this->password)
        ]);
        session()->forget('activeSetNewPassword');
        Auth::guard('vendor')->login($user);
        $this->dispatchBrowserEvent('success',__('text.Password Changed Successfully'));
        $this->redirect('/');
    }

    public function render()
    {
        return view('components.front.auth.forget-password');
    }

    public function resend(){
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->setErrorBag(["code"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.'),"phone"=> __('text.Slow down! Please wait another'). $exception->secondsUntilAvailable." ". __('text.seconds to send again.')]);
            return ;
        }
        $code=implode('',array_rand([0,1,2,3,4,5,6,7,8,9],6));
        send_sms('+2'.$this->phone,__('text.Your activation code is:')." ".$code);
        session()->put('code',$code);
        session()->put('phone',session()->get('phone'));
        session()->put('activeCodeField','');
        session()->put('time',time());
        $this->dispatchBrowserEvent('success',__('text.Message has been sent successfully'));
        $this->dispatchBrowserEvent('refreshCode',session()->get('time'));

    }


    public function cancel(){
        session()->forget('code');
        session()->forget('time');
        session()->forget('activeCodeField');
    }
}
