<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;

class LatestProducts extends Component
{

    public function render()
    {
        $latestProducts = Product::latest()->take(10)->get();
        return view('components.front.dashboard.latest-products',compact('latestProducts'));
    }
}
