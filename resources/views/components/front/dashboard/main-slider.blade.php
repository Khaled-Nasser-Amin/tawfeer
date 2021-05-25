<div class="wrap-main-slide">
    <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="true">
        <div class="item-slide">
            <img src="{{asset('/images/1.jpg')}}" alt="" class="img-slide">
        </div>
        <div class="item-slide">
            <img src="{{asset('/images/2.jpg')}}" alt="" class="img-slide">
        </div>
        <div class="item-slide">
            <img src="{{asset('/images/3.jpg')}}" alt="" class="img-slide">
        </div>
        <div class="item-slide">
            <img src="{{asset('/images/4.jpg')}}" alt="" class="img-slide">
        </div>
    </div>
</div>
@if(\App\Models\Category::count()>0)
    <div class="wrap-banner style-twin-default">
    @foreach(\App\Models\Category::all() as $category)
            <div class="banner-item " style="width:19%">
                <a class="link-banner banner-effect-1" data-cate-id="{{$category->id}}">
                    <span class="text-muted" >{{app()->getLocale() == 'ar' ? $category->name_ar:$category->name_en}}</span>
                    <figure><img src="{{$category->image}}" ></figure>
                </a>
            </div>
    @endforeach
    </div>
@endif



