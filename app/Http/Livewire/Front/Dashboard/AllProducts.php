<?php

namespace App\Http\Livewire\Front\Dashboard;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;
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
        $allProducts = Product::paginate(12);
        return view('components.front.dashboard.all-products',compact('allProducts'));
    }
}
