@extends('front.layouts.header')
@section('title',__('text.Update Spare'))
@push('css')
    <link rel="stylesheet" href="{{asset('css/toast.style.min.css')}}">
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="wrap-breadcrumb my-5" >
                <ol class="breadcrumb w-100 bg-white">
                    <li class="breadcrumb-item  active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{__('text.Edit Product')}}
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title mt-0">{{__('text.Fill in the Form')}}</h4>
                        @livewire('front.products.product-form',['action' => 'update('.$product->id.')','product' => $product])
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
    <script>
        window.addEventListener('success',e=>{
            $.Toast(e.detail," ",'success',{
                stack: false,
                position_class: "toast-top-center",
                rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
            });
        })

        //fire event to get product by id
        $(window).on('load',function (){
            window.Livewire.emit('edit')
        })
    </script>


@endpush
