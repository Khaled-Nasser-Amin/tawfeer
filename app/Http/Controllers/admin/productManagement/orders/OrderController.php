<?php

namespace App\Http\Controllers\admin\productManagement\orders;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        return view('admin.productManagement.vendors.index');

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Order $offer)
    {
        //
    }


    public function edit(Order $offer)
    {
        //
    }


    public function update(Request $request, Order $offer)
    {
        //
    }


    public function destroy(Order $offer)
    {

    }
}
