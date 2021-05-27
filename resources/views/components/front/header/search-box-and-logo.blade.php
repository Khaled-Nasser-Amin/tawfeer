<div class="w-100 mx-0 px-0">
    <div class="container">
        <div class="mid-section main-info-area">

            <div class="wrap-logo-top left-section w-25">
                <a href="{{route('front.dashboard')}}" class="link-to-home"><img src="{{asset('front/images/logoTawfeer.png')}}" alt="mercado"></a>
            </div>

            <div class="wrap-search center-section w-50">
                <div class="wrap-search-form w-100">
                    <form action="{{route('front.search')}}" id="form-search-top" class="row mx-0 px-0 w-100" name="form-search-top">
                        <button form="form-search-top" type="button" class="w-5 px-0 align-self-end" id="search-btn-icon"><i class="fa fa-search " aria-hidden="true"></i></button>
                        <div class="wrap-list-cate overflow-hidden w-25 align-self-end ">
                            <input type="hidden" name="product-cate" id="product-cate" value="{{request()->query('product-cate')}}">
                            <a href="#" class="link-control px-0">{{__('text.Categories')}}<i class="fas fa-toggle-down"></i></a>
                            <ul class="list-cate" id="cate">
                                <li class="level-0" onclick="getModels('all')" value="">{{__('text.Categories')}}</li>
                                @forelse(\App\Models\Category::latest()->get() as $category)
                                    <li onclick="getModels({{$category->id}})" class="level-{{$category->id}}" value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar:$category->name_en}}</li>
                                @empty
                                    <p>{{__('text.No Categories available Yet')}}<p>
                                @endforelse
                            </ul>
                        </div>
                        <select name="model" id="models" style="width: 20%;height: auto;background-color: #f6f6f6" class="form-control border-0 p-0">
                            <option value="" >@lang('text.Models')</option>
                        </select>
                        <input type="text" name="input_search" value="{{request()->query('input_search')}}" class="align-items-start" style="border:none;width: 40%" placeholder="{{__('text.Search')}}...">
                    </form>

                </div>
                <div class="wrap-icon right-section">
                    <div class="wrap-icon-section show-up-after-1024">
                        <a href="#" class="mobile-navigation mt-1" style="height: 35px;">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row h-100 mx-1 add-section w-100 row justify-content-center align-items-center mx-auto" >
                <div class="wrap-icon wish-list-section right-section w-50 px-2">
                    <div class="wrap-icon-section wishlist">
                    <a href="{{route('front.wishList')}}" class="link-direction">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <div class="left-info">
                            <span class="index">{{auth()->guard('vendor')->check() ? auth()->guard('vendor')->user()->wishList->count():'0'}} {{__('text.Product')}}</span>
                            <span class="title">{{__('text.Wishlist')}}</span>
                        </div>
                    </a>
                </div>
                </div>
                <a href="{{route('front.AddSpare')}}" id="addProduct" class="btn w-50 d-block m-auto" style="background-color: #efc82e; color: #ffffff"><i class="fa fa-plus-square"></i> {{__('text.Add Spare')}}</a>
            </div>

        </div>
    </div>

</div>

<script>
    let element=document.getElementById('search-btn-icon');
    element.addEventListener('click',function (e){
        e.preventDefault()
       document.getElementById('form-search-top').submit();
    })


</script>
@if (request()->query('product-cate') != null)
    <script>
        let cate=document.getElementsByClassName('level-{{request()->query("product-cate")}}')[0].innerHTML;
        document.getElementsByClassName('link-control')[0].innerHTML=cate+'<i class="fas fa-toggle-down"></i>';
    </script>
@endif
