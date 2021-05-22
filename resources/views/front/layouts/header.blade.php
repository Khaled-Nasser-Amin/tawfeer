<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    {{--#e6ca03--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="mdi mdi-car-hatchback">@yield('title')  | {{ __('text.Tawfeer')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front/images/titleIcon.png')}}">

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap.min.css')}}">
       <link rel="stylesheet" type="text/css" href="{{asset('front/css/chosen.min.css')}}">
--}}

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('front/css/color-01.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />

    @stack('css')
    <link rel="stylesheet" href="{{asset('css/toast.style.min.css')}}">
    <style>
        i{font-family: FontAwesome!important;}
        .form-control:focus{
            border-color: #f59524!important;
        }
    </style>
    @if ( LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">    <style>a{text-decoration:none ;}</style>
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

<main id="main" class="main-site">
    <div class="container">
        @yield('content')
    </div>
</main>
@include('front.layouts.footer')

<script src="{{asset('js/app.js')}}"></script>

{{--<script src="{{asset('front/js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('front/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('front/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}">
</script> <script src="{{asset('front/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>--}}


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
    window.addEventListener('success',e=> {
        $('.owl-carousel').owlCarousel();
    })
</script>
@stack('script')

</body>
</html>
