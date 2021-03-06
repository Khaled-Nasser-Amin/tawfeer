<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    {{--#e6ca03--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="mdi mdi-car-hatchback">@yield('title')  | {{ __('text.Tawfeer')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front/images/titleIcon.png')}}">

{{--    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('front/css/chosen.min.css')}}">

--}}



    <link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/color-01.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />

    @stack('css')
    @livewireStyles

    <link rel="stylesheet" href="{{asset('css/toast.style.min.css')}}">
    <style>
        i{font-family: FontAwesome!important;}
        .form-control:focus{
            border-color: #efc82e!important;
        }
    </style>
    @if ( LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{asset('css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('front/css/rtl.css')}}">
    @endif

</head>
<body class="home-page home-01 bg-white pb-0">

<!-- mobile menu -->
<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<!--header-->
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">

            {{--top bar--}}
            <x-front.header.top-bar />

            {{--search box and logo--}}
            <x-front.header.search-box-and-logo />

            {{--nav-bar--}}
            <x-front.header.nav-bar />
        </div>
    </div>
</header>

<main id="main" class="main-site" style="min-height: 800px">
    <div class="container">
        @yield('content')
    </div>
</main>
@include('front.layouts.footer')

<script src="{{asset('js/app.js')}}"></script>

{{--
<script src="{{asset('front/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('front/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
    <script src="{{asset('front/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('front/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
--}}


<script src="{{asset('front/js/jquery.sticky.js')}}"></script>
<script src="{{asset('front/js/functions.js')}}"></script>
<script src="{{asset('js/toast.script.js')}}"></script>
<script>
    window.addEventListener('success',e=>{
        $.Toast(e.detail,"",'success',{
            stack: false,
            position_class: "toast-top-center",
            rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
        });
    });
    window.addEventListener('danger',e=>{
        $.Toast(e.detail,"",'error',{
            stack: false,
            position_class: "toast-top-center",
            rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
        });
    })

    window.addEventListener('refresh-wish-list',route=>{
        $.ajax({
            'url':route.detail,
            'method':'get',
            success:function (result){
                let wishlist=$('.wish-list-section');
                wishlist.empty();
                wishlist.html($('.wish-list-section',result).html());
            }
        })
    })

function getModels(id){
    if (id == 'all'){
        $('.models_added').remove();
    }else if(id != '' && id != null && id != undefined && id != 1){
        $('.models_added').remove();
        $.ajax({
            method:'get',
            url:"/getALlModelsForCategory/"+id,
            success:function (result){
                let ids= Object.values(result)
                let names= Object.keys(result)
                for (i=0; i<names.length; i++){
                    $('#models').append('<option class="models_added" value="'+ids[i]+'" >'+names[i]+'</option>')
                }
                $('#models').append('<option class="models_added" value="other" >@lang('text.Other Models')</option>')

            }
        })
    }

}
$(document).ready(function (){
    getModels({{request()->query('product-cate')}});
})

</script>
@livewireScripts
@stack('script')

</body>
</html>
