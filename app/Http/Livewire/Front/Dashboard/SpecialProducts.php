<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialProducts extends Component
{
    public function render()
    {
        $specialProducts= Product::where('featured',1)->take(15)->get();
        return view('components.front.dashboard.special-products',compact('specialProducts'));
    }
}
