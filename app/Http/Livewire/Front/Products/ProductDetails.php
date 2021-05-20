<?php

namespace App\Http\Livewire\Front\Products;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product,$rateValue,$comment,$latestReviews,$highest_products_review;
    public function mount(Product $product){
        $this->product=$product;
        $this->highest_products_review=Product::where('reviews','>',0)->orderByDesc('reviews')->take(5)->get();
        $vendor=auth()->guard('vendor');
        if($vendor->check() && $vendor->user()->reviews()->find($product->id)) {
            $review=$vendor->user()->reviews()->where('product_id',$product->id)->first();
            $this->comment=$review->pivot->comment;
            $this->rateValue=$review->pivot->review;
        }
    }
    public function render()
    {
        $rating=$this->product->reviews()->count() != 0 ?
            round(($this->product->reviews()->sum('review')*5)/($this->product->reviews()->count()*5),1):0;
        $this->latestReviews=$this->product->reviews()->latest()->take(3)->get();
        return view('front.products.detail',compact('rating'))->extends('front.layouts.header')->section('content');
    }
    public function updated(){
        $this->redirectIfNotAuth();
    }
    public function updateWishList(Product $product){
        $this->redirectIfNotAuth();
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id)){
            $product->wishList()->detach(auth()->guard('vendor')->user());

        }else {
            $product->wishList()->syncWithoutDetaching(auth()->guard('vendor')->user());
        }
    }

    public function rate(Product $product){
        $this->redirectIfNotAuth();
        $this->rateValue=$this->rateValue ?? 5;
        $vendor=auth()->guard('vendor');

        if($vendor->check() && $vendor->user()->reviews()->find($product->id)){
            $product->reviews()->detach($vendor->user());
            $product->reviews()->syncWithoutDetaching([$vendor->user()->id =>['comment' => $this->comment,'review' => $this->rateValue]]);
            $this->dispatchBrowserEvent('success',__('text.Your review updated successfully'));

        }else {
            $product->update([
                'reviews' => ($product->reviews+1)
            ]);
            $product->save();
            $vendor->user()->reviews()->syncWithoutDetaching([$product->id=>['comment' => $this->comment,'review' => $this->rateValue]]);
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
