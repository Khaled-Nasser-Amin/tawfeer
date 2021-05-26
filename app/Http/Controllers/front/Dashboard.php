<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function dashboard(){

        return view('front.dashboard');
    }
    public function shop(){

        return view('front.shop.shop');
    }
    public function shopSetCategory(Request $request){
        session()->put('cate_id',$request->cate_id);
    }
}
