@section('title',__('text.Product Details'))
@push('css')
    @livewireStyles
    <style>
        .owl-item{
            margin-right: 10px!important;
        }
        .flex-control-nav{
            width: 100%!important;
            padding-left: 20px;
            margin-top: 40px;
        }
        .slides li{
            padding-left:50px ;
        }
        .btn.btn-wishlist:hover{
            cursor: pointer;
        }
        @if(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->exists($product->id))
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
                    <div class="product-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <a href="#" class="count-review">(05 review)</a>
                    </div>

                    <h2 class="product-name">{{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</h2>

                    <div class="short-desc">
                        <ul>
                            <li>Year of Manufacture : {{$product->YearOfManufacture}}</li>
                            <li>{{__('text.Description')}} : {{app()->getLocale() == 'ar' ?  $product->description_ar : $product->description_en}}</li>
                            <li><i class="fa fa-whatsapp text-success"></i> {{$product->whatsapp}}</li>
                            <li><i class="fa fa-phone"></i> {{$product->phone}}</li>
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
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#444444;border-radius: 10px"> Add to Wishlist </a>
                            @elseif(auth()->guard('vendor')->check() && auth()->guard('vendor')->user()->wishList()->exists($product->id))
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#f59524;border-radius: 10px"> Remove from Wishlist </a>
                            @elseif(auth()->guard('vendor')->check() && !auth()->guard('vendor')->user()->wishList()->exists($product->id))
                                <a wire:click="updateWishList({{$product->id}})" class="btn btn-wishlist text-white px-2 " style="background-color:#444444;border-radius: 10px"> Add to Wishlist </a>
                            @endif
                        </div>
                    </div>
                </div>





                {{--reviews--}}
                <div class="advance-info">
                    <div class="tab-control normal">
                        <a href="#review" class="tab-control-item">Reviews</a>
                    </div>
                    <div class="tab-contents">

                        <div class="tab-content-item active" id="review">

                            <div class="wrap-review-form">

                                <div id="comments">
                                    <h2 class="woocommerce-Reviews-title">01 review for <span>{{app()->getLocale() == 'ar' ? $product->name_ar :$product->name_en}}</span></h2>
                                    <ol class="commentlist">
                                        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                            <div id="comment-20" class="comment_container">
                                                <img alt="" src="{{asset('front/images/author-avata.jpg')}}" height="80" width="80">
                                                <div class="comment-text">
                                                    <div class="star-rating">
                                                        <span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
                                                    </div>
                                                    <p class="meta">
                                                        <strong class="woocommerce-review__author">admin</strong>
                                                        <span class="woocommerce-review__dash">–</span>
                                                        <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
                                                    </p>
                                                    <div class="description">
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div><!-- #comments -->


                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">


                                            <form wire:submit.prevent="rate" id="commentform" class="comment-form" >

                                                <div class="comment-form-rating">
                                                    <span>Your rating</span>
                                                    <p class="stars">
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
                                                    <label for="comment">Your comment <span class="required">*</span>
                                                    </label>
                                                    <textarea wire:model="comment" id="comment" name="comment" cols="45" rows="8"></textarea>
                                                </p>
                                                <p class="form-submit">
                                                    <input name="submit" wire:loading.attr="disabled" type="submit" id="submit" class="submit" value="Submit">
                                                </p>
                                            </form>

                                        </div><!-- .comment-respond-->
                                    </div><!-- #review_form -->
                                </div><!-- #review_form_wrapper -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end main products area-->


        {{--highest previews--}}

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">Popular Products</h2>
                <div class="widget-content">
                    <ul class="products">
                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="{{asset('front/images/products/digital_01.jpg')}}" alt=""></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                    <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                </div>
                            </div>
                        </li>

                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="{{asset('front/images/products/digital_17.jpg')}}" alt=""></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                    <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                </div>
                            </div>
                        </li>

                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="{{asset('front/images/products/digital_18.jpg')}}" alt=""></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                    <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                </div>
                            </div>
                        </li>

                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
                                        <figure><img src="{{asset('front/images/products/digital_20.jpg')}}" alt=""></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker...</span></a>
                                    <div class="wrap-price"><span class="product-price">$168.00</span></div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!--end sitebar-->
    </div>
</div>



@push('script')

    <script src="{{asset('front/js/jquery.flexslider.js')}}"></script>

    @livewireScripts
    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <script>
            $('.owl-carousel').owlCarousel({
                rtl:true,
                loop:false,
                margin:10,
                nav:true,
                navClass:["owl-next","owl-prev"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:5
                    },
                }
            })

            $('.owl-next').html('<i class="fa fa-angle-right" aria-hidden="true"></i>')
            $('.owl-prev').html('<i class="fa fa-angle-left" aria-hidden="true"></i>')
        </script>
    @endif

@endpush
