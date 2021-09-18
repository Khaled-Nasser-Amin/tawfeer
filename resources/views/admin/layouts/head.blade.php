
<head>
    <meta charset="utf-8" />
    <title class="mdi mdi-car-hatchback">@yield('title') | {{ __('text.Tawfeer')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta content="Car spare parts" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="{{asset('images/icons/car-estate.png')}}" type="image/icon type">

    <style>
        .enlarged .left-side-menu #sidebar-menu>ul>li{
            margin-left: 5px;
            margin-right: 5px;
            overflow: hidden;
        }
        .enlarged .left-side-menu #sidebar-menu>ul>li:hover{
            overflow: initial;
        }

    </style>
    @stack('css')
    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet" />

    @if ( LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{asset('css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
    @if(app()->getLocale() == 'en')
    <style>
        .dropdown-menu-right{
            left:0px!important;
        }
    </style>

    @endif
    <!-- Scripts -->
</head>
