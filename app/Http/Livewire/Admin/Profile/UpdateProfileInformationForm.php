<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Http\Controllers\admin\Profile\UpdateUserProfileInformation;
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

        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /*/**
     * Update the user's Profile information.*/

    public function updateProfileInformation(UpdateUserProfileInformation $updater)
    {
        $this->resetErrorBag();
        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        $this->emit('saved');
        $this->emit('refresh-navbar',route('profile.show'));
    }

    public function deleteProfilePhoto(){
        $this->livewireDeleteSingleImage($this->getUserProperty(),'users');
        $this->getUserProperty()->update([
            'image' => null
        ]);
        $this->emit('saved');
        $this->emit('refresh-navbar',route('profile.show'));
    }
    /*
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /*
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.Profile.update-profile-information-form');
    }
}
