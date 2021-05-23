<?php

namespace App\Http\Livewire\Front\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class WishList extends Component
{
    use WithPagination;
    public $search;
    public function updateWishList(Product $product){
        $this->redirectIfNotAuth();
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id)){
            $product->wishList()->detach(auth()->guard('vendor')->user());
            $this->dispatchBrowserEvent('success',__('text.Removed successfully from your favorite list'));
        }else {
            $product->wishList()->syncWithoutDetaching(auth()->guard('vendor')->user());
            $this->dispatchBrowserEvent('success',__('text.Added successfully to your favorite list'));

        }
        $this->dispatchBrowserEvent('refresh-wish-list',route('front.wishList'));
    }
    public function redirectIfNotAuth()
    {
        if (!auth()->guard('vendor')->check()){
            $this->redirect('/login');
        }
    }
    public function render()
    {
        $wishList=auth()->guard('vendor')->user()->wishList()
            ->when($this->search,function ($q){
                return $q->where('price',$this->search)
                    ->orWhere('name_ar','like','%'.$this->search.'%')
                    ->orWhere('name_en','like','%'.$this->search.'%');
            })
            ->latest()->paginate(15);
        return view('components.front.products.wish-list',compact('wishList'));
    }
}
