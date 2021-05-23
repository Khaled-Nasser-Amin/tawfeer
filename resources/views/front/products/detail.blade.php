@section('title',__('text.Product Details'))
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carousel.min.css')}}">

    <style>
        .owl-stage{
            display: flex;
            flex-direction: row;
        }
        .owl-item{
            margin-right: 10px!important;
        }
        .slides li{
            position: relative;
            right: 41px;
        }
        @if(app()->getLocale() == 'ar')
        .slides li{
            display: inline!important;
            float: right!important;
            position: relative;
            right: 0;
        }
        .owl-stage-outer{
            position: relative;
            right: -8px;
        }
        @endif

        .btn.btn-wishlist:hover{
            cursor: pointer;
        }
        @if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id))
            .btn.btn-wishlist:hover{
            background-color: #444444!important;
        }
        @endif
    </style>


@endpush



<div>
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{__('text.Product Details')}}</li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-product-detail">


                <div wire:ignore class="detail-media">
                    <div class="product-gallery">

                        <ul class="slides">

                            <li data-thumb="{{$product->image}}">
                                <img src="{{$product->image}}" alt="product thumbnail" />
                            </li>
                            @foreach($product->images as $image)
                                <li data-thumb="{{$image->name}}">
                                    <img src="{{$image->name}}" alt="product thumbnail" />
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>


                {{--product information--}}


                <div class="detail-info">
                    <div class="star-rating">
                        <span style="width: {{ $rating*20}}%"></span>

                    </div>
                    <p class="count-review d-inline">({{ $rating}})</p>

                    <h2 class="product-name">{{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</h2>


                    <div class="short-desc">
                        <ul>
                            <li><span class="font-weight-bold">{{__('text.Year of Manufacture')}}</span>: {{$product->YearOfManufacture}}</li>
                            <li><span class="font-weight-bold">{{__('text.Description')}}</span> : {{app()->getLocale() == 'ar' ?  $product->description_ar : $product->description_en}}</li>
                            <li><span class="font-weight-bold"><i class="fa fa-whatsapp text-success"></i></span> {{$product->whatsapp}}</li>
                            <li><span class="font-weight-bold"><i class="fa fa-phone"></i></span> {{$product->phone}}</li>
                            <li><span class="text-pink">{{__('text.Category Name')}}</span></li>
                            <ul class="slimscroll listCatScroll" >
                                @foreach($product->categories as $cat)
                                    <li>
                                        | <span class="text-pink">
                                        <a href="#" >{{app()->getLocale() == 'ar'? $cat->name_ar : $cat->name_en}}</a></span> |
                                    </li>
                                @endforeach
                            </ul>
                        </ul>
                    </div>
                    @if ($product->sale != null)
                        <div class="wrap-price"><ins><p class="product-price">${{$product->sale}}</p></ins> <del><p class="product-price">${{$product->price}}</p></del></div>
                    @else
                        <div class="wrap-price"><span class="product-price">${{$product->price}}</span></div>

                    @endif
                    <div class="wrap-butons mt-3">
                        <div class="wrap-btn w-100 row justify-content-center align-items-center">
                            @if(!auth()->guard('vendor')->check())
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#444444;border-radius: 10px"> {{__('text.Add to Wishlist')}} </a>
                            @elseif(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->find($product->id))
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#f59524;border-radius: 10px"> {{__('text.Remove from Wishlist')}} </a>
                            @elseif(auth()->guard('vendor')->check() && !auth()->guard('vendor')->user()->wishList()->find($product->id))
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#444444;border-radius: 10px"> {{__('text.Add to Wishlist')}} </a>
                            @endif
                        </div>
                    </div>
                </div>






        {{--//reviews--}}

                <div class="advance-info">
                    <div class="tab-control normal">
                        <a href="#review" class="tab-control-item">{{__('text.Reviews')}}</a>
                    </div>
                    <div class="tab-contents">

                        <div class="tab-content-item active" id="review">

                            <div class="wrap-review-form">

                                <div id="comments">
                                    <h2 class="woocommerce-Reviews-title">{{$product->reviews()->count()}} {{__('text.Review for')}} <span>{{app()->getLocale() == 'ar' ? $product->name_ar :$product->name_en}}</span></h2>
                                    <ol class="commentlist">
                                        @forelse($latestReviews as $review)
                                            <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                                <div id="comment-20" class="comment_container">
                                                    <img alt="" src="{{$review->image}}" height="80" width="80">
                                                    <div class="comment-text px-3">
                                                        <div class="star-rating">
                                                            <span style="width: {{$review->pivot->review * 20}}%"></span>
                                                        </div>
                                                        <p class="meta">
                                                            <strong class="woocommerce-review__author">{{$review->name}}</strong>
                                                            <span class="woocommerce-review__dash">–</span>
                                                            <time >{{$review->pivot->updated_at->diffForHumans()}}</time>
                                                        </p>
                                                        <div class="description">
                                                            <p>{{$review->pivot->comment}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                        @endforelse

                                    </ol>
                                </div>
                                <!-- #comments -->



                                <!-- #review_form_wrapper -->
                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">


                                            <form wire:submit.prevent="rate({{$product->id}})" id="commentform" class="comment-form" >

                                                <div class="comment-form-rating">
                                                    <span>{{__('text.Your Rating')}}</span>
                                                    <p class="stars ">
                                                        <label for="rated-1"></label>
                                                        <input type="radio" wire:model="rateValue" id="rated-1" name="rating" value="1">
                                                        <label for="rated-2"></label>
                                                        <input type="radio" id="rated-2" wire:model="rateValue" name="rating" value="2">
                                                        <label for="rated-3"></label>
                                                        <input type="radio" id="rated-3" wire:model="rateValue" name="rating" value="3">
                                                        <label for="rated-4"></label>
                                                        <input type="radio" id="rated-4" wire:model="rateValue" name="rating" value="4">
                                                        <label for="rated-5"></label>
                                                        <input type="radio" id="rated-5" wire:model="rateValue" name="rating" value="5" checked="checked">
                                                    </p>
                                                </div>
                                                <p class="comment-form-comment">
                                                    <label for="comment" class="float-none">{{__('text.Your Comment')}} <span class="required">*</span>
                                                    </label>
                                                    <textarea wire:model="comment" id="comment" name="comment" cols="45" rows="8"></textarea>
                                                </p>
                                                <p class="form-submit">
                                                    <input name="submit" wire:loading.attr="disabled" type="submit" id="submit" class="submit" value="{{__('text.Submit')}}">
                                                </p>
                                            </form>

                                        </div><!-- .comment-respond-->
                                    </div><!-- #review_form -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end main products area-->



{{--highest reviews--}}
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">{{__('text.Popular Products')}}</h2>
                <div class="widget-content">
                    <ul class="products">
                        @forelse($highest_products_review as $product_review)
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
        </div>

        <!--end sitebar-->
    </div>
</div>



@push('script')

    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.flexslider.js')}}"></script>

@endpush
