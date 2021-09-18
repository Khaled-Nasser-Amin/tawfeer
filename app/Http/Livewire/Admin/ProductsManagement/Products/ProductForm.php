<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Products;

use App\Http\Controllers\admin\productManagement\products\ProductController;
use App\Models\Category;
use App\Models\Images;
use App\Models\Model;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
use WithFileUploads;
    public $name_ar, $name_en,
        $description_ar,$description_en,
        $sale=0,$whatsapp,$phone,
        $image,$groupImage,$price,$type,$slug,$YearOfManufacture,$search,$models,$models_ids=[];

    public $products;     //all products
    public $productsIndex=[];     //no. of fields if the product is consist of a group of products
    public $categoriesIds=[];
    public $categories;

    public $action; // action for change form action between add new product and update product

    public $product;

    protected $listeners=['edit'];
    public function mount(){
        $this->categories=Category::latest()->get();
        $this->products=Product::where('type','single')->where('user_id',auth()->user()->id)->get();
        $this->productsIndex[]=['product_id' => '','quantity' => '' ];
    }

    public function edit(){
        $this->resetVariables();
        foreach ($this->product->groups as $child){
            $this->productsIndex[]=['product_id' => $child->id,'quantity' => $child->pivot->quantity];
        }
        $k=[];
        $arr=[];
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
        foreach ($this->product->models->pluck('id') as $id)
            $arr+=[$id => $id];
        foreach ($this->product->categories->pluck('id') as $id)
            $k+=[$id => $id];
        $this->models_ids=$arr;
        $this->categoriesIds=$k;


    }

    public function update($id){
        $this->categoriesIds=array_filter($this->categoriesIds);
        $this->models_ids=array_filter($this->models_ids);
        $productUpdate=new ProductController();
        foreach ($this->categoriesIds as $cate){
            $ids[]=Model::where('category_id',$cate)->pluck('id');
        }
        $data=$this->validationForUpdate($id);
        $collection=collect($ids)->collapse(); // all models ids for selected categories
        $data['models']=$collection->intersect($this->models_ids);
        $data=$this->setSlug($data);
        $product=$productUpdate->update($data,$id);
        $this->groupType($product);
        $this->dispatchBrowserEvent('success', __('text.Product Updated Successfully'));
    }

    public function store(){
        $this->categoriesIds=array_filter($this->categoriesIds);
        $this->models_ids=array_filter($this->models_ids);
        $productStore=new ProductController();
        foreach ($this->categoriesIds as $cate){
            $ids[]=Model::where('category_id',$cate)->pluck('id');
        }
        $data=$this->validation();
        $collection=collect($ids)->collapse(); // all models ids for selected categories
        $data['models']=$collection->intersect($this->models_ids);
        $data=$this->setSlug($data);
        $product=$productStore->store($data);
        auth()->user()->products()->save($product);
        $this->groupType($product);
        $this->resetVariables();
        $this->dispatchBrowserEvent('success', __('text.Product Added Successfully'));
    }

    public function render()
    {
        $this->models=[];
        if ($this->categoriesIds != null){
            foreach ($this->categoriesIds as $key=>$cat){
                if ($cat == false){
                    unset($this->models[$key]);
                }else{
                    $this->models+=[$key=>Model::where('category_id',$cat)->get()];

                }
            }
        }
        return view('components.admin.products.product-form');
    }

    public function validation(){

        return $this->validate([
            'name_ar' => 'required|string|max:255|',
            'name_en' => 'required|string|max:255|',
            'slug' => 'nullable|string|max:255|',
            'description_ar' => 'nullable|string|max:255|',
            'description_en' => 'nullable|string|max:255|',
            'type' => ['required', Rule::in(['single','group'])],
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
            'phone' => 'required|numeric',
            'whatsapp' => 'required|numeric',
            'YearOfManufacture' => 'required|integer',
            'categoriesIds' => 'required|array|min:1',
            'categoriesIds.*' => 'exists:categories,id',
            'models_ids' => 'nullable|array',
            'models_ids.*' => 'exists:models,id',
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
            'slug' => 'nullable|string|max:255|',
            'description_ar' => 'nullable|string|max:255|',
            'description_en' => 'nullable|string|max:255|',
            'type' => ['required', Rule::in(['single','group'])],
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric|lt:price',
            'categoriesIds' => 'required|array|min:1',
            'categoriesIds.*' => 'exists:categories,id',
            'models_ids' => 'nullable|array',
            'models_ids.*' => 'exists:models,id',
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
        $this->reset(['name_ar','name_en','description_ar',
        'description_en','image','price','slug','type',
        'sale','phone','whatsapp','YearOfManufacture','groupImage',]);
        $this->categoriesIds=[];
        $this->productsIndex=[];
        $this->models=[];
    }

    public function addProduct(){
        $this->productsIndex[]=['product_id' => '','quantity' => '' ];
    }

    public function deleteProduct($index){
        unset($this->productsIndex[$index]);
        array_values($this->productsIndex);
    }
    public function setSlug($data){
        if ($this->slug == null){
            $data['slug'] = $this->name_en.'-'.$this->name_ar;
        }
        return $data;
    }
}
