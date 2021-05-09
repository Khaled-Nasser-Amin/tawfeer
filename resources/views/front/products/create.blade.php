@extends('front.layouts.header')
@section('title',__('text.Add Spare'))
@push('css')
    <link rel="stylesheet" href="{{asset('css/toast.style.min.css')}}">
    @livewireStyles
    <style>
        i{font-family: FontAwesome!important;}

        .toast-item-wrapper .toast-top-center{
            margin-top: 40px!important;
        }
    </style>
@endpush
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="wrap-breadcrumb my-5" >
                <ol class="breadcrumb w-100 bg-white">
                    <li class="breadcrumb-item"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('text.Add Spare')}}</li>
                </ol>
            </div>

            <!-- end page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mt-0">{{__('text.Fill in the Form')}}</h4>

                        @livewire('front.products.product-form',['action' => 'store'])

                        <!-- end form -->
                    </div>
                    <!-- end card-box -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->

    </div>
    <!-- end content -->
@endsection
@push('script')
    <script src="{{asset('js/toast.script.js')}}"></script>
    @livewireScripts
    <script>
        window.addEventListener('success',e=>{
            $.Toast(e.detail,"",'success',{
                stack: false,
                position_class: "toast-top-center",
                rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
            });
        })
    </script>
@endpush
