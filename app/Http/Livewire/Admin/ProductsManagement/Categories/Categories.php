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
    /*public $parent;
    public $type;*/
    public $slug;
    public $ids;
    public $search;

    protected $listeners=['delete'];



    public function store(){
        $category=new CategoryController();
        $data=$this->validateData();
        /*$data['parent']=$this->parent;*/
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
        /*$this->parent=$cat->parent_id;
        $this->type=$cat->type;*/

    }

    public function update(){

        $data=$this->UpdateCategoryRequestValidate($this->ids);
        $category=new CategoryController();
        $category->update($data,$this->ids);
        session()->flash('success',__('text.Category Updated Successfully'));
        $this->resetVariables();
        $this->emit('updatedCategory');

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
        $categories=Category::/*with('child_categories')->*/when($this->search,function ($q){
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
            'slug' => 'required|string|max:255',
           'image' => 'required|mimes:jpg,png,jpeg,gif',
            /*'parent' => 'nullable|exists:categories,id',
            'type' => ['required',Rule::in(['Category','Product'])],*/
        ]);
    }

    public function UpdateCategoryRequestValidate($categoryId){
        return $this->validate([
            'name_ar' =>['required' , Rule::unique('categories','name_ar')->ignore($categoryId), Rule::unique('categories','name_en')->ignore($categoryId)],
            'name_en' =>['required' , Rule::unique('categories','name_ar')->ignore($categoryId), Rule::unique('categories','name_en')->ignore($categoryId)],
            'slug' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif',
           /* 'parent' => ['nullable',Rule::exists('categories','id')->whereNot('id',$categoryId)],
            'type' => ['required',Rule::in(['Category','Product'])],*/
        ]);

    }


    public function resetVariables(){
        $this->name_ar= null;
        $this->name_en=null;
        $this->image = null;
        $this->slug=null;
        /*$this->parent=null;
        $this->type=null;*/
        $this->ids=null;
    }
}
