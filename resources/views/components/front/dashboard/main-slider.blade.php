<div class="wrap-main-slide">
    <div id="carouselExampleIndicators" class="carousel slide my-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('/images/1.jpg')}}" alt="" class="img-slide w-100">
            </div>
            <div class="carousel-item">
                <img src="{{asset('/images/2.jpg')}}" alt="" class="img-slide w-100">
            </div>
            <div class="carousel-item">
                <img src="{{asset('/images/3.jpg')}}" alt="" class="img-slide w-100" >
            </div>
            <div class="carousel-item">
                <img src="{{asset('/images/4.jpg')}}" alt="" class="img-slide w-100">
            </div>
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
</div>
@if(\App\Models\Category::count()>0)
    <div class="wrap-banner style-twin-default">
    @foreach(\App\Models\Category::latest()->get() as $category)
            <div class="banner-item mx-1" style="width:18%;height: 200px">
                <a class="link-banner banner-effect-1" data-cate-id="{{$category->id}}">
                    <div style="border-radius: 20px;height: 100%;background-image: url('{{$category->id == 1 ? (app()->getLocale() == "ar" ? asset("images/categories/other_ar.png"):asset("images/categories/other_en.png")) : $category->image}}');background-size: cover"></div>
                </a>
            </div>
    @endforeach
    </div>
@endif



