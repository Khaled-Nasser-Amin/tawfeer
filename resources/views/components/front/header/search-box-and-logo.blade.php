<div class="w-100 mx-0 px-0 row justify-content-center align-items-center ">
    <div class="container">
        <div class="mid-section main-info-area">

            <div class="wrap-logo-top left-section w-25">
                <a href="{{route('front.dashboard')}}" class="link-to-home"><img src="{{asset('front/images/logoTawfeer.png')}}" alt="mercado"></a>
            </div>

            <div class="wrap-search center-section w-50">
                <div class="wrap-search-form w-100">
                    <form action="#" id="form-search-top" class="row mx-0 px-0 w-100" name="form-search-top">
                        <button form="form-search-top" type="button" class="w-5 px-0 align-self-end"><i class="fa fa-search " aria-hidden="true"></i></button>
                        <div class="wrap-list-cate overflow-hidden w-25 align-self-end ">
                            <input type="hidden" name="product-cate" value="0" id="product-cate">
                            <a href="#" class="link-control px-0">{{__('text.All Categories')}} <i class="fa fa-toggle-down"></i></a>
                            <ul class="list-cate">
                                <li class="level-0">{{__('text.All Categories')}}</li>
                                <li class="level-1">-Electronics</li>
                                <li class="level-2">Batteries & Chargens</li>
                                <li class="level-2">Headphone & Headsets</li>
                                <li class="level-2">Mp3 Player & Acessories</li>
                                <li class="level-1">-Smartphone & Table</li>
                                <li class="level-2">Batteries & Chargens</li>
                                <li class="level-2">Mp3 Player & Headphones</li>
                                <li class="level-2">Table & Accessories</li>
                                <li class="level-1">-Electronics</li>
                                <li class="level-2">Batteries & Chargens</li>
                                <li class="level-2">Headphone & Headsets</li>
                                <li class="level-2">Mp3 Player & Acessories</li>
                                <li class="level-1">-Smartphone & Table</li>
                                <li class="level-2">Batteries & Chargens</li>
                                <li class="level-2">Mp3 Player & Headphones</li>
                                <li class="level-2">Table & Accessories</li>
                            </ul>
                        </div>
                        <input type="text" name="search" value="" class="w-50 align-items-start" placeholder="Search here...">
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

            <div class="row h-100 mx-1 add-section w-50 row justify-content-center align-items-center mx-auto" >
                <a href="{{route('front.AddSpare')}}" id="addProduct" class="btn w-100 d-block m-auto" style="background-color: #f59524; color: #ffffff"><i class="fa fa-plus-square"></i> {{__('text.Add Spare')}}</a>
            </div>

        </div>
    </div>

</div>
