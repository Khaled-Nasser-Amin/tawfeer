<?php

namespace App\Http\Controllers\admin\productManagement\products;
use App\Http\Controllers\Controller;

use App\Models\Images;
use App\Traits\ImageTrait;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    use ImageTrait;

    public function store($request)
    {
        $data=collect($request)->except(['categoriesIds','image','groupImage'])->toArray();
        $data=$this->livewireAddSingleImage($request,$data,'products');
        $product=Product::create($data);
        $imagesNames=$this->livewireGroupImages($request,'products');
        $this->associateImagesWithProduct($imagesNames,$product);
        $product->categories()->syncWithoutDetaching($request['categoriesIds']);
        if($request['models']){
            $product->models()->syncWithoutDetaching($request['models']);
        }

        return $product;
    }

    public function associateImagesWithProduct($images,$product){
        foreach ($images as $image)
         Images::create(['name'=>$image])->product()->associate($product->id)->save();
    }

    public function update($request,$id)
    {
        $product=Product::findOrFail($id);
        $this->authorize('update',$product);
        $data=collect($request)->except(['categoriesIds','image','groupImage'])->toArray();
        if ($request['image']){
            $data=$this->livewireAddSingleImage($request,$data,'products');
            $this->livewireDeleteSingleImage($product,'products');
        }
        if ($request['groupImage']){
            $this->livewireDeleteGroupOfImages($product->images,'products');
            $imagesNames=$this->livewireGroupImages($request,'products');
            $this->associateImagesWithProduct($imagesNames,$product);
        }
        $product->update($data);
        $product->save();
        if ($product->categories->count() > 0 ){
            $product->categories()->detach();
        }
        $product->categories()->syncWithoutDetaching($request['categoriesIds']);
        $product->models()->detach();
        if($request['models']){
            $product->models()->syncWithoutDetaching($request['models']);
        }
        return $product;
    }
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $this->livewireDeleteSingleImage($product,'products');
        $this->livewireDeleteGroupOfImages($product->images,'products');
        $product->delete();
    }

    public function addNewProduct(){
        return view('admin.productManagement.products.create');
    }
    public function updateProduct(Product $product){
        $this->authorize('view',$product);
        return view('admin.productManagement.products.edit',compact('product'));
    }




}
