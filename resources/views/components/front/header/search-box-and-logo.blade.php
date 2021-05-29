<div class="w-100 mx-0 px-0">
    <div class="container">
        <div class="mid-section main-info-area">

            <div class="wrap-logo-top left-section w-25">
                <a href="{{route('front.dashboard')}}" class="link-to-home"><img src="{{asset('front/images/logoTawfeer.png')}}" alt="mercado"></a>
            </div>

            <div class="wrap-search center-section w-50">
                <div class="wrap-search-form w-100 row">
                    <form action="{{route('front.search')}}" id="form-search-top" class=" mx-0 px-0 w-100 row justify-content-between" name="form-search-top">

                        <div class="row d-flex mx-0" style="width: 85%">
                            <select name="product-cate"  onchange="getModels(this.value)" style="width: 50%;height: auto;background-color: #f6f6f6" class="d-inline-block form-control border-0 m-0 py-1" >
                                <option value="all" {{request()->query('product-cate') == 'all' ? 'selected' :''}}>@lang('text.All Cars')</option>
                                @forelse(\App\Models\Category::latest()->get() as $category)
                                    <option {{request()->query('product-cate') == $category->id ? 'selected' :''}} value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar:$category->name_en}}</option>
                                @empty
                                    <p>{{__('text.No Cars available Yet')}}<p>
                                @endforelse
                            </select>
                            <input type="text" name="spare_name" value="{{request()->query('spare_name')}}" class="order-2 align-items-start" style="border:none;width: 50%" placeholder="{{__('text.Spare\'s name')}}...">
                            <select name="model" id="models" style="width: 50%;height: auto;background-color: #f6f6f6" class="d-inline-block form-control border-0 m-0 py-1">
                               <option value="" >@lang('text.Models')</option>
                           </select>
                           <input type="text" name="yearOfManufacture" value="{{request()->query('yearOfManufacture')}}" class="order-3 align-items-start" style="border:none;width: 50%" placeholder="{{__('text.Year of Manufacture')}}...">

                       </div>
                       <div class="row d-flex  mx-0 overflow-hidden" style="width: 15%;">
                           <button form="form-search-top" type="button" class="w-100 h-100 px-0 align-self-end" id="search-btn-icon"><i class="fa fa-search " aria-hidden="true"></i></button>
                       </div>

                    </form>

                </div>
                <div class="wrap-icon right-section mx-3">
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

