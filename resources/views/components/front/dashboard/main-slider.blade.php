<div class="wrap-main-slide my-4" style="height: 400px">
    <div id="carouselExampleIndicators" class="carousel slide h-100" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < \App\Models\Banner::count(); $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
            @endfor
        </ol>
        <div class="carousel-inner h-100">
            @foreach(\App\Models\Banner::where('show_in','home')->get() as $banner)
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
</div>
@if(\App\Models\Category::count()>0)
    <div class="wrap-banner style-twin-default">
    @foreach(\App\Models\Category::latest()->get() as $category)
            <div class="banner-item mx-1" style="width:18%;height: 200px">
                <a class="link-banner banner-effect-1" data-cate-id="{{$category->id}}">
                    <div style="border-radius: 20px;height: 100%;">
                        <img class="w-100 h-100" style="border-radius: 20px" src="{{$category->id == 1 ? (app()->getLocale() == "ar" ? asset("images/categories/other_ar.png"):asset("images/categories/other_en.png")) : $category->image}}" alt="">
                    </div>
                </a>
            </div>
    @endforeach
    </div>
@endif



