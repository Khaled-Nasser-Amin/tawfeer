@if($specialProducts->count() > 0)
<div class="wrap-show-advance-info-box style-1 w-100">
    <h3 class="title-box">{{__('text.Special Products')}}</h3>

    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <div class="tab-contents">
                <div class="tab-content-item active p-0 pl-2" id="digital_1a">
                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container row " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                        @foreach($specialProducts as $product)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{route('front.viewDetail',[$product->id,$product->slug])}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{$product->image}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        @if ($product->type == 'group')
                                            <span class="flash-item new-label">{{__('text.Group')}}</span>
                                        @endif
                                        @if ($product->sale != null)
                                            <span class="flash-item sale-label">{{__('text.sale')}}</span>
                                        @endif
                                    </div>
                                    <div class="wrap-btn">
                                        @if(!auth()->guard('vendor')->check())
                                            <a data-product-id="{{$product->id}}" href="#" class="function-link add_product_to_Wishlist" > {{__('text.Add to Wishlist')}} </a>
                                        @elseif(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id))
                                            <a data-product-id="{{$product->id}}" href="#" class="function-link text-white px-2 add_product_to_Wishlist" style="background-color:#efc82e;border-radius: 10px"> {{__('text.Remove from Wishlist')}} </a>
                                        @elseif(auth()->guard('vendor')->check() && !auth()->guard('vendor')->user()->wishList()->find($product->id))
                                            <a data-product-id="{{$product->id}}" href="#" class="function-link add_product_to_Wishlist" > {{__('text.Add to Wishlist')}} </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{route('front.viewDetail',[$product->id,$product->slug])}}" class="product-name"><span>{{app()->getLocale() == 'ar' ?$product->name_ar:$product->name_en}}</span></a>
                                    @if ($product->sale != null)
                                        <div class="wrap-price"><ins><p class="product-price">${{$product->sale}}</p></ins> <del><p class="product-price">${{$product->price}}</p></del></div>
                                    @else
                                        <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>

                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
