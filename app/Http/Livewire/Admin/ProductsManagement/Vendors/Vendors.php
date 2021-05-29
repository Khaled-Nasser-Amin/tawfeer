<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Vendors;

use App\Models\Vendor;
use App\Traits\ImageTrait;
use Livewire\Component;
use Livewire\WithPagination;

class Vendors extends Component
{
    use WithPagination,ImageTrait;
    public $search;

    protected $listeners=['delete'];
    public function confirmDelete($id){
        $this->emit('confirmDelete', $id);
    }
    public function delete(Vendor $vendor){
        $this->livewireDeleteSingleImage($vendor,'users');
        $vendor->delete();
        session()->flash('success',__('text.Category Deleted Successfully'));
    }
    public function render()
    {
        $users=Vendor::when($this->search,function ($q){
             $q->where('name','like','%'.$this->search.'%')
                ->orWhere('phone','like','%'.$this->search.'%');
        })->latest()->paginate(10);
        return view('admin.productManagement.vendors.index',compact('users'))->extends('admin.layouts.appLogged')->section('content');
    }
}
