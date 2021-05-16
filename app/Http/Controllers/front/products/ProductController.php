<?php

namespace App\Http\Controllers\front\products;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Traits\ImageTrait;
use App\Models\Product;

class ProductController extends Controller
{
    use ImageTrait;

    public function viewDetail(Product $product, $slug){
        return view('front.products.detail');
    }
    public function store($request)
    {
        $data=collect($request)->except(['categoriesIds','image','groupImage'])->toArray();
        $data=$this->livewireAddSingleImage($request,$data,'products');
        $product=Product::create($data);
        $imagesNames=$this->livewireGroupImages($request,'products');
        $this->associateImagesWithProduct($imagesNames,$product);
        $product->categories()->syncWithoutDetaching($request['categoriesIds']);
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
        $product->categories()->syncWithoutDetaching($request['categoriesIds']);
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
        if (auth()->guard('vendor')->check())
            return view('front.products.create');
        return view('front.Auth.login');
    }
    public function updateProduct(Product $product){
        $this->authorize('view',$product);
        return view('front.products.edit',compact('product'));
    }


}
