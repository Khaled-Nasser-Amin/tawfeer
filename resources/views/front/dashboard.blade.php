@extends('front.layouts.header')
@section('title',__('text.Home'))
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carousel.min.css')}}">

    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>
@endpush
@section('content')
    <x-front.dashboard.main-slider />
    @livewire('front.dashboard.latest-products')
    @livewire('front.dashboard.special-products')
    @livewire('front.dashboard.highest-products')
    @livewire('front.dashboard.all-products')
@endsection
@push('script')
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>

    <script>
        $('.add_product_to_Wishlist').on('click',function (e){
            e.preventDefault()
            let item=$(this);
            let product_id=$(this).data('product-id');
            $.ajax({
                url:"/wish-list/add/"+product_id,
                type:'get',
                data:{
                    '_token':"{{csrf_token()}}",
                },
                success:function (e){
                    if (e == 'attaching'){
                        item.addClass('text-white');
                        item.css({'background-color':'#efc82e','border-radius':'10px'});
                        item.html("{{__('text.Remove from Wishlist')}}");
                        $.Toast("{{__('text.Added successfully to your favorite list')}}","",'success',{
                            stack: false,
                            position_class: "toast-top-center",
                            rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
                        });

                    }else if(e == 'detaching'){
                        item.removeClass('text-white');
                        item.css({'background-color':'#000000','border-radius':'0px'});
                        item.html("{{__('text.Add to Wishlist')}}");
                        $.Toast("{{__('text.Removed successfully from your favorite list')}}","",'success',{
                            stack: false,
                            position_class: "toast-top-center",
                            rtl: {{app()->getLocale()=='ar' ? "true" : 'false'}}
                        });

                    }
                    $.ajax({
                        'url':'/',
                        'method':'get',
                        success:function (result){
                            let wishlist=$('.wish-list-section');
                            wishlist.empty();
                            wishlist.html($('.wish-list-section',result).html());
                        }
                    })

                }
            })
        })
    </script>

@endpush
