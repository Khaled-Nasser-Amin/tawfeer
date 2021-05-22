<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;

class SpecialProducts extends Component
{
    public function updateWishList(Product $product){
        $this->redirectIfNotAuth();
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id)){
            $product->wishList()->detach(auth()->guard('vendor')->user());
            $this->dispatchBrowserEvent('success',__('text.Removed successfully from your favorite list'));
        }else {
            $product->wishList()->syncWithoutDetaching(auth()->guard('vendor')->user());
            $this->dispatchBrowserEvent('success',__('text.Added successfully to your favorite list'));

        }
    }
    public function redirectIfNotAuth()
    {
        if (!auth()->guard('vendor')->check()){
            $this->redirect('/login');
        }
    }
    public function render()
    {
        $specialProducts= Product::where('featured',1)->take(15)->get();
        return view('components.front.dashboard.special-products',compact('specialProducts'));
    }
}
