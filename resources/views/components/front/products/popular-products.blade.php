<div class="widget mercado-widget widget-product">
    <h2 class="widget-title">{{__('text.Popular Products')}}</h2>
    <div class="widget-content">
        <ul class="products">
            @forelse($products as $product_review)
                <li class="product-item">
                    <div class="product product-widget-style">
                        <div class="thumbnnail">
                            <a href="{{route('front.viewDetail',[$product_review->id,$product_review->slug])}}" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                <figure><img src="{{$product_review->image}}" alt=""></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{route('front.viewDetail',[$product_review->id,$product_review->slug])}}" class="product-name"><span>{{app()->getLocale() == 'ar' ? $product_review->name_ar:$product_review->name_en}} ({{$product_review->reviews}})</span></a>
                            @if ($product_review->sale != null)
                                <div class="wrap-price"><ins><p class="product-price">${{$product_review->sale}}</p></ins> <del><p class="product-price">${{$product_review->price}}</p></del></div>
                            @else
                                <div class="wrap-price"><span class="product-price">${{$product_review->price}}</span></div>

                            @endif
                        </div>
                    </div>
                </li>

            @empty
            @endforelse

        </ul>
    </div>
</div>
