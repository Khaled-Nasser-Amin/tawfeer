<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Products;

use App\Http\Controllers\admin\productManagement\products\ProductController;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $price;
    public $category;
    public $searchText;
    public $filterProducts;

    protected $listeners=['delete'];

    public function mount(){
        if(session()->has('price'))
            $this->price=session()->get('price');
        if(session()->has('category'))
            $this->category=session()->get('category');
        if(session()->has('productName'))
            $this->searchText=session()->get('productName');

        session()->forget(['price','category','productName']);
    }

    public function render()
    {

        $categories=Category::all();
        $products=Product::with('categories')
            ->when($this->price,function ($q) {
                $q->where('products.price',$this->price)
                ->orWhere('products.sale',$this->price);
            })->when($this->searchText,function ($q){
                return $q->where('products.name_ar','like','%'.$this->searchText.'%')
                    ->orWhere('products.name_en','like','%'.$this->searchText.'%');
            })->when($this->filterProducts,function ($q){
                if ($this->filterProducts == "myProducts"){
                    return $q->where('products.user_id',auth()->user()->id);
                }
            })
            ->when($this->category,function ($q)  {
                return $q->join('products_categories','products_categories.product_id','=','products.id')
                    ->join('categories','categories.id','=','products_categories.category_id')->where('categories.id','=',$this->category)
                    ->select('products.*');

            })->distinct('products.id')->latest('products.created_at')->paginate(12);


        return view('admin.productManagement.products.index',compact('products','categories'))->extends('admin.layouts.appLogged')->section('content');
    }

    public function confirmDelete($id){

        $this->emit('confirmDelete',$id);
    }
    public function delete($id){
        $instance=new ProductController();
        $instance->destroy($id);
        session()->flash('success',__('text.Product Deleted Successfully') );
    }
    public function updateFeatured($id){
        $numberOfProducts=Product::where('featured',1)->count();
        $product=Product::findOrFail($id);
        if ($numberOfProducts < 15 || $product->featured == 1){
            $featured=$product->featured == 0 ? 1 : 0;
            $product->update([
                'featured'=>$featured
            ]);
        }else{
            $this->dispatchBrowserEvent('danger',__('text.You have only 15 special products'));
        }

    }


}
