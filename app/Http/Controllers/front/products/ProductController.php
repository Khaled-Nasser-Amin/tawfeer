<?php

namespace App\Http\Controllers\front\products;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Images;
use App\Traits\ImageTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageTrait;

    public function search(Request $request){
        $products=Product::when($request->input('product-cate'),function ($q)use($request){
            $q->join('products_categories','products_categories.product_id','=','products.id')
                ->join('categories','categories.id','=','products_categories.category_id')
                ->where('categories.id',$request->input('product-cate'))
                ->select('products.*');
        })->when($request->input('model'),function ($q) use($request){
            if ($request->input('model') != 'other'){
                return $q->join('products_models', 'products_models.product_id', '=', 'products.id')
                    ->join('models', 'models.id', '=', 'products_models.model_id')->where('products_models.model_id', $request->input('model'))
                    ->select('products.*');
            }else{
                return $q->doesntHave('models');
            }

        })->where(function ($q) use($request){
            $q-> when($request->input('spare_name'),function ($q)use($request){
                return $q->where('products.name_ar','like','%'.$request->input('spare_name').'%')
                    ->orWhere('products.name_en','like','%'.$request->input('spare_name').'%');
            })->when($request->input('yearOfManufacture'),function ($q)use($request){
                    return   $q->where('products.YearOfManufacture','like','%'.$request->input('yearOfManufacture').'%');
                });
        })
        ->latest('products.created_at')->paginate(12);

        return view('front.products.search',compact('products'));
    }

    public function getALlModelsForCategory(Category $category){
        return $category->models->pluck('id','name');
    }

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
            $product->models()->detach();
            if($request['models']){
                $product->models()->syncWithoutDetaching($request['models']);
            }
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
        return view('front.auth.login');
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
