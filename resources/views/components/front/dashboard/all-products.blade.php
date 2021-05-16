<div class="wrap-show-advance-info-box style-1 w-100">
    <h3 class="title-box">All Products</h3>

<div class="row col-12 py-2">
    @forelse($allProducts as $product)
        <div class="product product-style-2 equal-elem w-25">
            <div class="product-thumnail">
                <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                    <figure><img src="{{$product->image}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                </a>
                <div class="group-flash">
                    @if ($product->type == 'group')
                        <span class="flash-item new-label">group</span>
                    @endif
                    @if ($product->sale != null)
                        <span class="flash-item sale-label">sale</span>
                    @endif
                </div>
                <div class="wrap-btn">
                    <a href="#" class="function-link">Add to favorite</a>
                </div>
            </div>
            <div class="product-info">
                <a href="#" class="product-name"><span>{{app()->getLocale() == 'ar' ?$product->name_ar:$product->name_en}}</span></a>
                @if ($product->sale != null)
                    <div class="wrap-price"><ins><p class="product-price">${{$product->sale}}</p></ins> <del><p class="product-price">${{$product->price}}</p></del></div>
                @else
                    <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>

                @endif
            </div>
        </div>
    @empty
        <div class="product product-style-2 equal-elem h-100 ">
            No products available yet
        </div>
    @endforelse

</div>

</div>
<div class="col-12 text-dark!important my-3">
    {{$allProducts->links()}}
</div>
