<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;
    public function render()
    {
        $allProducts = Product::paginate(12);
        return view('components.front.dashboard.all-products',compact('allProducts'));
    }
}
