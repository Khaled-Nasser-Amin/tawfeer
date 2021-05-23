@extends('front.layouts.header')
@section('title',__('text.My Products'))
@push('css')
    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>
    <link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}"rel="stylesheet"type="text/css"/>

@endpush
@section('content')
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{__('text.Wishlist')}}</li>
        </ol>
    </div>

    <!-- all products -->
    @livewire('front.products.my-products')


@endsection
@push('script')
    <script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        //event fired to livewire called delete
        window.Livewire.on('confirmDelete',function (e) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: '{{__("text.Are you sure?")}}',
                text: '{{__("text.You won't be able to revert this!")}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{__("text.Yes, delete it!")}}',
                cancelButtonText: '{{__("text.No, cancel!")}}',
                reverseButtons: true
            }).then((result) => {
                if (result.value == true) {
                    window.Livewire.emit('delete',e)
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '{{__("text.Cancelled")}}',
                        '{{__("text.Your imaginary file is safe :)")}}',
                        'error'
                    )
                }
            })

        })


    </script>

@endpush
