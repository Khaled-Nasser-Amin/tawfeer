<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $latestProducts = Product::latest()->take(10)->get();
        $specialProducts= Product::where('featured',1)->take(15)->get();
        return view('front.dashboard',compact('latestProducts','specialProducts'))->extends('front.layouts.header')->section('content');
    }
}
