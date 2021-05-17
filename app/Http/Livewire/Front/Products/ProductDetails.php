<?php

namespace App\Http\Livewire\Front\Products;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product,$rateValue,$comment;
    public function mount(Product $product){
        $this->product=$product;
    }
    public function render()
    {
        return view('front.products.detail')->extends('front.layouts.header')->section('content');
    }
    public function updated(){
        $this->redirectIfNotAuth();
    }
    public function updateWishList(Product $product){
        $this->redirectIfNotAuth();
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->exists($product->id)){
            $product->wishList()->detach(auth()->guard('vendor')->user());

        }else {
            $product->wishList()->syncWithoutDetaching(auth()->guard('vendor')->user());
        }
    }

    public function rate(Product $product){
        $this->redirectIfNotAuth();
        $this->rateValue=$this->rateValue ?? 5;
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->reviews()->exists($product->id)){
            $product->reviews()->detach(auth()->guard('vendor')->user());
            $product->reviews()->syncWithoutDetaching([auth()->guard('vendor')->user()->id =>['comment' => $this->comment,'review' => $this->rateValue]]);
        }else {
            $product->reviews()->syncWithoutDetaching([auth()->guard('vendor')->user()->id =>['comment' => $this->comment,'review' => $this->rateValue]]);
        $this->dispatchBrowserEvent('success',__('text.Thank you for your review'));
        }
    }

    public function redirectIfNotAuth()
    {
        if (!auth()->guard('vendor')->check()){
            $this->redirect('/login');
        }
    }
}
