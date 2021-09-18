<?php

namespace App\Http\Livewire\Front\Profile;

use App\Http\Controllers\front\Profile\UpdateUserProfileInformation;
use App\Models\Vendor;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads,ImageTrait;

    /*
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /*
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;
    public $code;

    /*
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {

        $this->state = Auth::guard('vendor')->user()->withoutRelations()->toArray();
    }

    /*/**
     * Update the user's Profile information.*/

    public function updateProfileInformation(UpdateUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        $updater->update(
            $this->getUserProperty(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if(!session()->has('phone') && $this->getUserProperty()->phone != $this->state['phone']){
            session()->put('phone',$this->state['phone']);
            $this->resend();
        }

        if($this->state['phone'] != $this->getUserProperty()->phone){
            $this->updatePhone($updater);
        }



        if ($this->getUserProperty()->wasChanged()){
            $this->emit('saved');
            $this->emit('refresh-navbar',route('front.profile.show'));
        }


    }

    public function resend(){
        $code=implode('',array_rand([0,1,2,3,4,5,6,7,8,9],6));
/*        send_sms('+201025070424',__('text.Your activation code is:')." ".$code);*/
        session()->put('code',$code);
        session()->put('phone',session()->get('phone'));
        session()->put('activeCodeField','');
        session()->put('time',time());
        $this->dispatchBrowserEvent('success',__('text.Message has been sent successfully'));
        $this->dispatchBrowserEvent('refreshCode',session()->get('time'));

    }

    public function updatePhone($updater){
        if (session()->has('time') && time() < (session()->get('time')+(5*60)) ){
            if(session()->has('code') && session()->get('code') == $this->code){
                if(session()->has('phone')){
                    $this->state['phone']=session()->pull('phone');
                    $updater->update(
                        $this->getUserProperty(),
                        $this->photo
                            ? array_merge($this->state, ['photo' => $this->photo])
                            : $this->state
                        ,true);
                    $this->cancel();
                    $this->code=null;
                }
            }else{
                $this->addError('code',__('text.Invalid Code!'));
                $this->dispatchBrowserEvent('danger',__('text.Invalid Code!'));
            }
        }else{
            $this->addError('code',__('text.CODE EXPIRED,please resend the activation code or cancel the operation.'));
            $this->dispatchBrowserEvent('danger',__('text.CODE EXPIRED,please resend the activation code or cancel the operation.'));
        }

    }

    public function cancel(){
        session()->forget('code');
        session()->forget('time');
        session()->forget('phone');
        session()->forget('activeCodeField');
    }


    public function deleteProfilePhoto(){
        $this->livewireDeleteSingleImage($this->getUserProperty(),'users');
        $this->getUserProperty()->update([
            'image' => null
        ]);
        $this->emit('saved');
        $this->emit('refresh-navbar',route('front.profile.show'));
    }
    /*
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::guard('vendor')->user();
    }

    /*
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('front.Profile.update-profile-information-form');
    }
}
