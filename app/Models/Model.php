<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as RealModel;

class Model extends RealModel
{
    use HasFactory;
    protected $fillable=['name'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'products_models');
    }
}
