<?php

namespace App\Http\Controllers\front\Profile;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserProfileController extends Controller
{

    public function show(Request $request)
    {
        return view('front.Profile.show', [
            'request' => $request,
            'user' => auth()->guard('vendor')->user(),
        ]);
    }
}
