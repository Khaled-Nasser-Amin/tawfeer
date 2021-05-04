<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name_ar','name_en','slug','image'/*,'type','parent_id'*/];
    protected $guarded=[];

   /* public function child_categories(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent_category(){
        return $this->belongsTo(Category::class,'parent_id');
    }*/

    public function products(){
        return $this->belongsToMany(Product::class,'products_categories');
    }
    public function getImageAttribute($value){
        return asset('images/categories/'.$value);
    }
    public function getSlugAttribute($value){
        return Str::slug($value);
    }
}
