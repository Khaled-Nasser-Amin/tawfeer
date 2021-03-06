<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as RealModel;
use Illuminate\Support\Str;

class Product extends RealModel
{
    use HasFactory;
    protected $fillable=[
        'name_ar', 'name_en',
        'slug', 'description_ar',
        'description_en', 'phone',
        'YearOfManufacture', 'sale', 'type',
        'price', 'whatsapp','image','featured','reviews'
    ];

    protected $guarded=[''];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function reviews(){
        return $this->belongsToMany(Vendor::class,'product_reviews')->withPivot('review','comment')->withTimestamps();
    }
    public function wishList(){
        return $this->belongsToMany(Vendor::class,'wish_list');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'products_categories');
    }
    public function models(){
        return $this->belongsToMany(Model::class,'products_models');
    }
    //this relation about Images that belongs to specific product in table images

    public function images(){
        return $this->hasMany(Images::class);
    }
    //this relation about make product as a group of sub products  in table products_groups

    public function groups(){
        return $this->belongsToMany(Product::class,'products_groups','child_product_id','parent_product_id')->withPivot('quantity');
    }

    //this relation about existing product in table groups
    public function child_products(){
        return $this->belongsToMany(Product::class,'products_groups','parent_product_id','child_product_id')->withPivot('quantity');
    }

    public function getSlugAttribute($value){
        return Str::slug($value);
    }

    public function getImageAttribute($value){
        return asset('images/products/'.$value);
    }





}
