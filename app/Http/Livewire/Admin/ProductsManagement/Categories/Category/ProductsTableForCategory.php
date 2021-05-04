<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Categories\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsTableForCategory extends Component
{
    use WithPagination;
    public $category,$search;
    protected $listeners=['categoryDetails' => 'edit'];

    public function mount(Category $category){
        $this->category=$category;
    }
    public function render()
    {
        $products= $this->category->products()->when($this->search,function ($q){
            $q->join('categories','products_categories.category_id','=','categories.id')
                ->select('products.*')
                ->where([['products.name_en','like','%'.$this->search.'%'],['categories.id','=',$this->category->id]])
                ->orwhere([['products.name_ar','like','%'.$this->search.'%'],['categories.id','=',$this->category->id]])
                ->orWhere([['products.price','like','%'.$this->search.'%'],['categories.id','=',$this->category->id]])
                ->orWhere([['products.sale','like','%'.$this->search.'%'],['categories.id','=',$this->category->id]]);
        })->latest()->paginate(3);
        return view('components.admin.categories.category.products-table-for-category',compact('products'));
    }


    public function searchByProduct($price,$category,$productName){
        session()->put('price' , $price);
        session()->put('category', $category);
        session()->put('productName' , $productName);
    }
}
