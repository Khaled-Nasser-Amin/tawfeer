<?php

namespace App\Http\Controllers\front\Profile;

use App\Http\Contracts\DeletesUsers;
use Illuminate\Support\Facades\DB;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->getAttributes()['image'] ? unlink($user->image): null;
        DB::table('sessions')->where('vendor_id',$user->id)->delete();
        $user->delete();
    }
}
