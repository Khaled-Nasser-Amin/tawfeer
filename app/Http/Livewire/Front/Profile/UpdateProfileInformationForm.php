<?php

namespace App\Http\Livewire\Front\Profile;

use App\Http\Controllers\front\Profile\UpdateUserProfileInformation;
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
            Auth::guard('vendor')->user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        $this->emit('saved');
        $this->emit('refresh-navbar',route('front.profile.show'));
    }

    public function deleteProfilePhoto(){
        $this->livewireDeleteSingleImage($this->getUserProperty(),'users');
        $this->getUserProperty()->update([
            'image' => null
        ]);
        $this->photo=null;
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
        return view('front.Profile.update-Profile-information-form');
    }
}
