@php
$banners= \App\Models\Banner::where('show_in','shop')->where(function($q){
    return $q->where('expire_at','>',Carbon\Carbon::now()->toDateTimeString())->orWhere('expire_at',null);
});
@endphp
<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area mx-0 " style="overflow-y: scroll ">
    <div id="carouselExampleIndicators" class="carousel slide h-25 {{ $banners->count() > 0 ? '' : 'd-none' }}" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < $banners->count(); $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
            @endfor
        </ol>
        <div class="carousel-inner h-100">
            @foreach($banners->get() as $banner)
                <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}} img-slide w-100  h-100" style="background-image: url('{{$banner->image}}');background-size: cover;background-repeat: no-repeat">
                    @if ($banner->url)
                        <a class="btn  banner_url " href="{{$banner->url}}" >@lang('text.View')</a>

                    @endif
                </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="wrap-shop-control">

        <div class="wrap-right row mx-0 justify-content-center w-100">

            <div class="sort-item  col-md-4 col-sm-12 ">
                <select name="orderby" class="form-control" wire:model="sort">
                    <option value="date-newest" selected="selected">@lang('text.Default Sorting by newest')</option>
                    <option value="popularity">@lang('text.Sort by popularity')</option>
                    <option value="date-oldest">@lang('text.Sort by oldest')</option>
                    <option value="price-asc">@lang('text.Sort by price: low to high')</option>
                    <option value="price-desc">@lang('text.Sort by price: high to low')</option>
                </select>
            </div>

            <div class="sort-item col-md-4 col-sm-12">
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

            <div class="sort-item col-md-4 col-sm-12">
                <input type="text" wire:model="spare_name"  class="form-control"  placeholder="{{__('text.Spare\'s name')}}...">
            </div>
            <div class="sort-item col-md-4 col-sm-12">
                <input type="text" wire:model="yearOfManufacture"  class="form-control" placeholder="{{__('text.Year of Manufacture')}}...">
            </div>


        </div>

    </div><!--end wrap shop control-->

    <div class="row mx-0 mt-3">

        <ul class="product-list grid-products equal-container row mx-0">
            @forelse($products as $product)
                <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    <div class="product product-style-3 equal-elem h-100">
                        <div class="product-thumnail h-75">
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
