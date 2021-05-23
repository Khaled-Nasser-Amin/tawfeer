<?php

namespace App\Http\Controllers\front\products;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Traits\ImageTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageTrait;

    public function search(Request $request){
/*        dd($request->input('input_search'),$request->input('product-cate'));*/
        $products=Product::latest()->paginate(12);
        return view('front.products.search',compact('products'));
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
        if ($product->vendor_id == auth()->guard('vendor')->user()->id){
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
            return $product;
        }else{
            return response('',403);
        }

    }
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        if($product->vendor_id == auth()->guard('vendor')->user()->id){
            $this->livewireDeleteSingleImage($product,'products');
            $this->livewireDeleteGroupOfImages($product->images,'products');
            $product->delete();
        }
    }

    public function addNewProduct(){
        if (auth()->guard('vendor')->check())
            return view('front.products.create');
        return view('front.Auth.login');
    }
    public function updateProduct(Product $product){
        $this->authorize('UpdateProductVendor',$product);
        return view('front.products.edit',compact('product'));
    }

    public function myProducts(){
        return view('front.products.my-products');
    }
    public function wishList(){
        return view('front.products.wish-list');
    }
    public function AddProductToWishList(Product $product){
        $this->redirectIfNotAuth();
        if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id)){
            $product->wishList()->detach(auth()->guard('vendor')->user());
            return 'detaching';
        }else {
            $product->wishList()->syncWithoutDetaching(auth()->guard('vendor')->user());
            return  'attaching';
        }
    }
    public function redirectIfNotAuth()
    {
        if (!auth()->guard('vendor')->check()){
            return redirect('/login');
        }
    }
}
