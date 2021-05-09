<?php

namespace App\Http\Livewire\Front\Profile;

use App\Http\Controllers\front\Profile\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class DeleteUserForm extends Component
{
    /*
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /*
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /*
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatchBrowserEvent('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /*
     * Delete the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $Auth
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Request $request, DeleteUser $deleter)
    {
        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::guard('vendor')->user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('text.This password does not match our records.')],
            ]);
        }

        $deleter->delete(Auth::guard('vendor')->user()->fresh());

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /*
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('front.Profile.delete-user-form');
    }
}
