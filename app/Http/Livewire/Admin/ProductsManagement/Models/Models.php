<?php

namespace App\Http\Livewire\Admin\ProductsManagement\Models;

use App\Http\Controllers\admin\productManagement\categories\CategoryController;
use App\Models\Category;
use App\Models\Model;
use BaconQrCode\Common\Mode;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Models extends Component
{
    use WithFileUploads,WithPagination;

    public $name;
    public $cate_id;
    public $search;
    public $model_id;
    public $filter_cate_id;

    protected $listeners=['delete'];



    public function store(){

        $data=$this->validateData();
        $model=Model::create(['name' => $data['name']]);
        $model->category()->associate($data['cate_id'])->save();
        session()->flash('success', __('text.Model Created Successfully'));
        $this->resetVariables();
        $this->emit('addNewModel');

    }

    public function edit($id){
          $this->model_id=$id;
          $model=Model::findOrFail($id);
          $this->name= $model->name;
          $this->cate_id=$model->category->id;
    }

    public function update(){
        $data=$this->UpdateCategoryRequestValidate($this->model_id);
        $model=Model::findOrFail($this->model_id);
        $model->update(['name' => $data['name']]);
        $model->category()->associate($data['cate_id'])->save();
        session()->flash('success',__('text.Model Updated Successfully'));
        $this->resetVariables();
        $this->emit('updatedModel');
    }

    public function confirmDelete($id){
        $this->emit('confirmDelete', $id);
    }
    public function delete($id){
        $model=Model::findOrFail($id);
        $model->delete();
        session()->flash('success',__('text.Model Deleted Successfully'));
    }

    public function render()
    {
        $categories=Category::where('id','!=',1)->get();
        $models=Model::when($this->search,function ($q){
                $q->where('name','like','%'.$this->search.'%');
            })->when($this->filter_cate_id,function ($q){
                $q->where('category_id',$this->filter_cate_id);
            })->latest()->paginate(10);
        return view('admin.productManagement.models.index',compact('categories','models'))->extends('admin.layouts.appLogged')->section('content');
    }

    public function validateData()
    {
       return $this->validate([
            'name' => 'required|string|max:255|unique:models|',
            'cate_id' => 'required|max:255|exists:categories,id|',

        ]);
    }

    public function UpdateCategoryRequestValidate($modelId){
        return $this->validate([
            'name' =>['required' , Rule::unique('models','name')->ignore($modelId)],
            'cate_id' => 'required|max:255|exists:categories,id|',

        ]);

    }


    public function resetVariables(){
      $this->name= null;
      $this->cate_id=null;
    }

}
