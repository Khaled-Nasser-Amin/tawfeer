<?php

namespace App\Http\Livewire\Front\Products;

use App\Http\Controllers\front\products\ProductController;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class MyProducts extends Component
{
    use WithPagination;
    public $search;
    protected $listeners=['delete'];

    public function render()
    {
        $myProducts=Product::where('vendor_id',auth()->guard('vendor')->user()->id)
            ->when($this->search,function ($q){
                return $q->where('whatsapp','like','%'.$this->search.'%')
                    ->orWhere('phone','like','%'.$this->search.'%')
                    ->orWhere('name_ar','like','%'.$this->search.'%')
                    ->orWhere('name_en','like','%'.$this->search.'%')
                    ->orWhere('price',$this->search);
            })
            ->latest()->paginate(15);
        return view('components.front.products.card-show',compact('myProducts'));
    }
    public function confirmDelete($id){
          $this->emit('confirmDelete',$id);
    }
    public function delete($id){
        $instance=new ProductController();
        $instance->destroy($id);
        $this->dispatchBrowserEvent('success',__('text.Product Deleted Successfully') );
    }
}
