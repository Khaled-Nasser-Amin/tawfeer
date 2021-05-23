<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Product $product)
    {
       return $user->id == $product->user_id;
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Product $product)
    {
        return $user->id == $product->user_id;
    }


    public function delete(User $user, Product $product)
    {
        //
    }


    public function UpdateProductVendor(Vendor $vendor, Product $product)
    {
        return $vendor->id == $product->vendor_id;
    }



    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
