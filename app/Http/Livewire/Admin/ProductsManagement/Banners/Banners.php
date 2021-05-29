<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Banners;

use App\Models\Banner;
use App\Models\Vendor;
use App\Traits\ImageTrait;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Banners extends Component
{
    use WithPagination,ImageTrait,WithFileUploads;
    public $search,$url,$name,$image,$show_in,$expired_at,$ids;

    protected $listeners=['deleteBanner'];

    public function store(){
       $data= $this->validateData();
       $data= $this->livewireAddSingleImage($data,$data,'banners');
       Banner::create($data);
       session()->flash('success', __('text.Banner Created Successfully'));
       $this->resetVariables();
        $this->emit('addedBanner');

    }
    public function validateData()
    {
        return $this->validate([
            'name' => 'required|string|max:255|unique:banners',
            'show_in' => 'required|string|max:255|in:home,shop',
            'url' => 'nullable|url|max:255',
            'image' => 'required|mimes:jpg,png,jpeg,gif',
            'expired_at' => 'nullable|date|after:today',
        ]);
    }
    public function edit($id){
        $this->ids=$id;
        $banner=Banner::findOrFail($id);
        $this->name= $banner->name;
        $this->url=$banner->url;
        $this->expired_at=$banner->expired_at;
        $this->show_in=$banner->show_in;
    }

    public function update(){
        $data= $this->UpdateBannerRequestValidate($this->ids);
        $banner=Banner::findOrFail($this->ids);
        $data=array_filter( $data);
        if ($this->image != null){
            $this->livewireDeleteSingleImage($banner,'banners');
            $data= $this->livewireAddSingleImage($data,$data,'banners');
        }
        $banner->update($data);
        $banner->save();
        session()->flash('success', __('text.Banner Updated Successfully'));
        $this->resetVariables();
        $this->emit('updatedBanner');
    }

    public function UpdateBannerRequestValidate($Id){
        return $this->validate([
            'name' =>['required' , Rule::unique('banners','name')->ignore($Id)],
            'show_in' => 'required|string|max:255|in:home,shop',
            'url' => 'nullable|url|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
            'expired_at' => 'nullable|date|after:today',
        ]);

    }

    public function confirmDelete($id){
        $this->emit('confirmDeleteBanner', $id);
    }

    public function deleteBanner(Banner $banner){
        $this->livewireDeleteSingleImage($banner,'banners');
        $banner->delete();
        session()->flash('success',__('text.Banner Deleted Successfully'));
    }
    public function render()
    {
        $banners=Banner::when($this->search,function ($q){
            return $q->where('name','like','%'.$this->search.'%')
                ->orWhere('url','like','%'.$this->search.'%');
        })->latest()->paginate(10);
        return view('admin.productManagement.banners.index',compact('banners'))->extends('admin.layouts.appLogged')->section('content');
    }

    public function resetVariables(){
        $this->name= null;
        $this->url=null;
        $this->expired_at = null;
        $this->image=null;
        $this->show_in=null;
    }
}
