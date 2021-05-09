<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $categories=Category::count();
        $products=Product::count();
        $vendors=Vendor::count();
        $myProducts=auth()->user()->products()->count();
        return view('admin.dashboard',compact('categories','products','vendors','myProducts'));
    }
}
