<?php

namespace App\Http\Livewire\Front\Products;

use App\Http\Controllers\front\products\ProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
use WithFileUploads;
    public $name_ar, $name_en,
        $description_ar,$description_en,
        $sale,$whatsapp,$phone,$categoriesIds,
        $image,$groupImage,$price,$type,$slug,$YearOfManufacture,$search;

    public $products;     //all products
    public $productsIndex=[];     //no. of fields if the product is consist of a group of products

    public $categories;

    public $action; // action for change form action between add new product and update product

    public $product;

    protected $listeners=['edit'];
    public function mount(){
        $this->categories=Category::all();
        $this->products=Product::where('type','single')->where('vendor_id',auth()->guard('vendor')->user()->id)->get();
        $this->productsIndex[]=['product_id' => '','quantity' => '' ];
    }

    public function edit(){
        $this->resetVariables();
        foreach ($this->product->groups as $child){
            $this->productsIndex[]=['product_id' => $child->id,'quantity' => $child->pivot->quantity];
        }
        $this->name_ar= $this->product->name_ar;
        $this->name_en=$this->product->name_en;
        $this->description_ar=$this->product->description_ar;
        $this->description_en=$this->product->description_en;
        $this->price=$this->product->price;
        $this->slug=$this->product->slug;
        $this->type=$this->product->type;
        $this->sale=$this->product->sale;
        $this->phone=$this->product->phone;
        $this->whatsapp=$this->product->whatsapp;
        $this->YearOfManufacture=$this->product->YearOfManufacture;
        $this->categoriesIds=$this->product->categories->pluck('id');

    }

    public function update($id){
        $productUpdate=new ProductController();
        $data=$this->validationForUpdate($id);
        $product=$productUpdate->update($data,$id);
        $this->groupType($product);
        $this->dispatchBrowserEvent('success', __('text.Product Updated Successfully'));
    }

    public function store(){
        $productStore=new ProductController();
        $data=$this->validation();
        $product=$productStore->store($data);
        auth()->guard('vendor')->user()->products()->save($product);
        $this->groupType($product);
        $this->resetVariables();
        $this->dispatchBrowserEvent('success', __('text.Product Added Successfully'));
    }
    public function render()
    {

        return view('components.front.products.product-form');
    }

    public function validation(){

        return $this->validate([
            'name_ar' => 'required|string|max:255|',
            'name_en' => 'required|string|max:255|',
            'slug' => 'required|string|max:255|',
            'description_ar' => 'required|string|max:255|',
            'description_en' => 'required|string|max:255|',
            'type' => ['required', Rule::in(['single','group'])],
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
            'phone' => 'required|numeric',
            'whatsapp' => 'required|numeric',
            'YearOfManufacture' => 'required|integer',
            'categoriesIds' => 'required|array|min:1',
            'categoriesIds.*' => 'exists:categories,id',
            'image' => 'required|mimes:jpg,png,jpeg,gif',
            'groupImage' => 'required|array|min:1',
            'groupImage.*' => 'mimes:jpeg,jpg,png',
            'productsIndex' =>'required_if:type,group',
            'productsIndex.*.product_id' => 'required_if:type,group|numeric|exists:products,id',
            'productsIndex.*.quantity' => 'required_if:type,group|numeric|min:1',
        ]);

    }
    public function validationForUpdate($id){

        return $this->validate([
            'name_ar' => 'required|string|max:255|',
            'name_en' => 'required|string|max:255|',
            'slug' => 'required|string|max:255|',
            'description_ar' => 'required|string|max:255|',
            'description_en' => 'required|string|max:255|',
            'type' => ['required', Rule::in(['single','group'])],
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
            'categoriesIds' => 'required|array|min:1',
            'categoriesIds.*' => 'exists:categories,id',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'phone' => 'required|numeric',
            'whatsapp' => 'required|numeric',
            'YearOfManufacture' => 'required|integer',
            'groupImage' => 'nullable|array|min:1',
            'groupImage.*' => 'mimes:jpeg,jpg,png',
            'productsIndex' =>'required_if:type,group',
            'productsIndex.*.product_id' => 'required_if:type,group|numeric|exists:products,id',
            'productsIndex.*.quantity' => 'required_if:type,group|numeric|min:1',
        ]);

    }

    public function groupType($product){
        if ($this->type == 'group'){
            $productsGroup=collect($this->productsIndex)->groupBy('product_id')->map(function ($value){
                return [$value[0]['product_id'] => $value->sum('quantity')];
            });
            foreach ($productsGroup as $key =>$value){
                $product->groups()->syncWithoutDetaching([$key=>['quantity'=>$value[$key]]]);
            }
        }else{
            $product->groups()->detach();
        }

    }
    public function resetVariables(){
        $this->name_ar= null;
        $this->name_en=null;
        $this->description_ar=null;
        $this->description_en=null;
        $this->image = null;
        $this->price=null;
        $this->slug=null;
        $this->type=null;
        $this->sale=null;
        $this->phone=null;
        $this->whatsapp=null;
        $this->YearOfManufacture=null;
        $this->categoriesIds=null;
        $this->groupImage=null;
        $this->productsIndex=[];
    }

    public function addProduct(){
        $this->productsIndex[]=['product_id' => '','quantity' => '' ];
    }

    public function deleteProduct($index){
        unset($this->productsIndex[$index]);
        array_values($this->productsIndex);
    }

}
