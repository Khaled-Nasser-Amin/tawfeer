<?php

namespace App\Http\Controllers\front\Profile;

use App\Traits\ImageTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{

    use ImageTrait;
    /*
     * Validate and update the given user's Profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input,$verified = false)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['numeric', Rule::unique('vendors')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo']))
        {
            $request['image']=$input['photo'];
            $data=$this->livewireAddSingleImage($request,$data=[],'users');
            $this->livewireDeleteSingleImage($user,'users');
            $user->update([
                'image' => $data['image']
            ]);
            $user->save();
        }

        if ($input['phone'] !== $user->phone && $verified) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
            ])->save();
        }
    }

    /*
     * Update the given verified user's Profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'phone' => $input['phone'],
        ])->save();

    }


}
