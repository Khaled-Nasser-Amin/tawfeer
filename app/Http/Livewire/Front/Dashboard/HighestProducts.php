<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;

class HighestProducts extends Component
{

    public function render()
    {
        $highestProducts= Product::where('reviews','>',0)->take(15)->get();
        return view('components.front.dashboard.highest-products-reviews',compact('highestProducts'));
    }
}
