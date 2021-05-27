<?php

namespace App\Http\Livewire\Front\Shop;

use App\Http\Controllers\front\products\ProductController;
use App\Models\Category;
use App\Models\Model;
use App\Models\Product;
use BaconQrCode\Common\Mode;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public $search ,$highest_products_review,$sort,$pagination,$min_price,$max_price,$category,$models,$model_id;
    public function mount(){

        $this->category=session()->has('cate_id')? session()->pull('cate_id'):null;
        $this->sort="date-newest";
        $this->min_price=0;
        $this->max_price=999999;
        $this->pagination="12";
        $this->highest_products_review=Product::where('reviews','>',0)->orderByDesc('reviews')->take(5)->get();
    }

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

    public function sortBy(){
        $this->min_price=$this->min_price < 0 ? 0 :$this->min_price;
        $this->max_price=$this->max_price < 0 ? 999999 :$this->max_price;
        switch ($this->sort){
            case 'popularity':return "reviews";
            case 'price-asc':
            case 'price-desc':return "price";
            case 'date-newest':
            case 'date-oldest':
            default : return "created_at";
        }
    }

    public function setModels(){
        if ($this->category != null ){
            $this->models=Model::where('category_id',$this->category)->get();
        }else{
            $this->models=[];
        }
    }

    public function render()
    {
        $this->setModels();
        $sortBy=$this->sortBy();
        $this->pagination=(int)$this->pagination > 32 ? 12 :(int)$this->pagination;
        if ($this->sort == 'price-asc' || $this->sort == 'date-oldest'){
            $allProducts = Product::when($this->category,function($q){
                    return $q->join('products_categories','products_categories.product_id','=','products.id')
                        ->join('categories','categories.id','=','products_categories.category_id')->where('products_categories.category_id',$this->category)
                        ->select('products.*');
                })->when($this->model_id,function ($q){
                if ($this->model_id != 'other'){
                    return $q->join('products_models', 'products_models.product_id', '=', 'products.id')
                        ->join('models', 'models.id', '=', 'products_models.model_id')->where('products_models.model_id', $this->model_id)
                        ->select('products.*');
                }else{
                    return $q->doesntHave('models');
                }

            })
                ->whereBetween('products.price', [$this->min_price, $this->max_price])->orderBy('products.' . $sortBy)->paginate($this->pagination);

        }else{
            $allProducts = Product::
               when($this->category, function ($q) {
                    return $q->join('products_categories', 'products_categories.product_id', '=', 'products.id')
                        ->join('categories', 'categories.id', '=', 'products_categories.category_id')->where('products_categories.category_id', $this->category)
                        ->select('products.*');

            })->when($this->model_id,function ($q){
                if ($this->model_id != 'other'){
                    return $q->join('products_models', 'products_models.product_id', '=', 'products.id')
                        ->join('models', 'models.id', '=', 'products_models.model_id')->where('products_models.model_id', $this->model_id)
                        ->select('products.*');
                }else{
                    return $q->doesntHave('models');
                }

            })->whereBetween('products.price',[$this->min_price,$this->max_price])->orderByDesc('products.'.$sortBy)->paginate($this->pagination);


        }

        return view('components.front.shop.shop',compact('allProducts'));
    }

}
