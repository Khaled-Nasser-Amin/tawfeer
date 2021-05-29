<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

    <div class="banner-shop">
        <a href="#" class="banner-link">
            <figure><img src="{{asset('images/5.jpg')}}" alt=""></figure>
        </a>
    </div>

    <div class="wrap-shop-control">

        <div class="wrap-right row mx-0 justify-content-center w-100">

            <div class="sort-item  col-4 ">
                <select name="orderby" class="form-control" wire:model="sort">
                    <option value="date-newest" selected="selected">@lang('text.Default Sorting by newest')</option>
                    <option value="popularity">@lang('text.Sort by popularity')</option>
                    <option value="date-oldest">@lang('text.Sort by oldest')</option>
                    <option value="price-asc">@lang('text.Sort by price: low to high')</option>
                    <option value="price-desc">@lang('text.Sort by price: high to low')</option>
                </select>
            </div>

            <div class="sort-item col-4 ">
                <select name="post-per-page" class="form-control" wire:model="pagination">
                    <option value="12" selected="selected">@lang('text.Show') 12 @lang('text.per page')</option>
                    <option value="16">@lang('text.Show') 16 @lang('text.per page')</option>
                    <option value="18">@lang('text.Show') 18 @lang('text.per page')</option>
                    <option value="21">@lang('text.Show') 21 @lang('text.per page')</option>
                    <option value="24">@lang('text.Show') 24 @lang('text.per page')</option>
                    <option value="30">@lang('text.Show') 30 @lang('text.per page')</option>
                    <option value="32">@lang('text.Show') 32 @lang('text.per page')</option>
                </select>
            </div>
            @if(count($models) > 0)
            <div class="sort-item col-4">
                <select name="post-per-page" class="form-control" wire:model="model_id">
                    <option value="" selected="selected">@lang('text.All Models')</option>
                    @foreach($models as $model)
                        <option value="{{$model->id}}">{{$model->name}}</option>
                    @endforeach
                    <option value="other">@lang('text.Other Models')</option>
                </select>
            </div>
            @endif

            <div class="sort-item col-4 ">
                <input type="text" wire:model="spare_name"  class="form-control"  placeholder="{{__('text.Spare\'s name')}}...">
            </div>
            <div class="sort-item col-4">
                <input type="text" wire:model="yearOfManufacture"  class="form-control" placeholder="{{__('text.Year of Manufacture')}}...">
            </div>


        </div>

    </div><!--end wrap shop control-->

    <div class="row mt-3">

        <ul class="product-list grid-products equal-container row">
            @forelse($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail h-75" >
                            <a href="{{route('front.viewDetail',[$product->id,$product->slug])}}" title="{{app()->getLocale() == 'ar' ?$product->description_ar:$product->description_en}}">
                                <figure><img src="{{$product->image}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-name"><span>{{app()->getLocale() == 'ar' ?$product->name_ar:$product->name_en}} ({{$product->reviews}})</span></a>
                            @if ($product->sale != null)
                                <div class="wrap-price"><ins><p class="product-price">${{$product->sale}}</p></ins> <del><p class="product-price">${{$product->price}}</p></del></div>
                            @else
                                <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>
                            @endif

                            @if(!auth()->guard('vendor')->check())
                                <a wire:click.prevent="updateWishList({{$product->id}})" href="#" class=" add-to-cart " > {{__('text.Add to Wishlist')}} </a>
                            @elseif(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id))
                                <a wire:click.prevent="updateWishList({{$product->id}})" href="#" class="btn btn-wishlist add-to-cart text-white px-2 " style="background-color:#efc82e;border-radius: 10px"> {{__('text.Remove from Wishlist')}} </a>
                            @elseif(auth()->guard('vendor')->check() && !auth()->guard('vendor')->user()->wishList()->find($product->id))
                                <a wire:click.prevent="updateWishList({{$product->id}})" href="#" class="add-to-cart" > {{__('text.Add to Wishlist')}} </a>
                            @endif
                        </div>
                    </div>
                </li>

            @empty
                <li class="mx-5">
                    @lang('text.No Data Yet')
                </li>

            @endforelse



        </ul>

    </div>

    <div class="wrap-pagination-info">
        {{$products->links()}}
    </div>
</div>
