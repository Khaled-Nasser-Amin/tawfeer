<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Categories;

use App\Http\Controllers\admin\productManagement\categories\CategoryController;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithFileUploads,WithPagination;

    public $name_ar;
    public $name_en;
    public $image;

    public $slug;
    public $ids;
    public $search;

    protected $listeners=['delete'];



    public function store(){
        $category=new CategoryController();
        $data=$this->validateData();
        /*$data['parent']=$this->parent;*/
        $data=$this->setSlug($data);
        $category->store($data);
        session()->flash('success', __('text.Category Created Successfully'));
        $this->resetVariables();
        $this->emit('addedCategory');

    }

    public function edit($id){
        $this->ids=$id;
        $cat=Category::findOrFail($id);
        $this->name_ar= $cat->name_ar;
        $this->name_en=$cat->name_en;
        $this->slug=$cat->slug;
    }

    public function update(){
        if ($this->ids != 1){
            $data=$this->UpdateCategoryRequestValidate($this->ids);
            $data=$this->setSlug($data);
            $category=new CategoryController();
            $category->update($data,$this->ids);
            session()->flash('success',__('text.Category Updated Successfully'));
            $this->resetVariables();
            $this->emit('updatedCategory');
        }
    }

    public function confirmDelete($id){
        $this->emit('confirmDelete', $id);
    }
    public function delete($id){
        $category=new CategoryController();
        $category->destroy($id);
        session()->flash('success',__('text.Category Deleted Successfully'));
    }

    public function render()
    {
        $categories=Category::where('id','!=',1)->when($this->search,function ($q){
            return $q->where('name_ar','like','%'.$this->search.'%')
                ->orWhere('name_en','like','%'.$this->search.'%');
        })->paginate(10);
        return view('admin.productManagement.categories.index',compact('categories'))->extends('admin.layouts.appLogged')->section('content');
    }

    public function validateData()
    {
       return $this->validate([
            'name_ar' => 'required|string|max:255|unique:categories|unique:categories,name_en',
            'name_en' => 'required|string|max:255|unique:categories|unique:categories,name_ar',
            'slug' => 'nullable|string|max:255',
           'image' => 'required|mimes:jpg,png,jpeg,gif',

        ]);
    }

    public function UpdateCategoryRequestValidate($categoryId){
        return $this->validate([
            'name_ar' =>['required' , Rule::unique('categories','name_ar')->ignore($categoryId), Rule::unique('categories','name_en')->ignore($categoryId)],
            'name_en' =>['required' , Rule::unique('categories','name_ar')->ignore($categoryId), Rule::unique('categories','name_en')->ignore($categoryId)],
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',

        ]);

    }


    public function resetVariables(){
        $this->reset(['name_ar','name_en','image','slug','ids']);
    }

    public function setSlug($data){
        if ($this->slug == null){
            $data['slug'] = $this->name_en.'-'.$this->name_ar;
        }
        return $data;

    }
}
