@extends('front.layouts.header')
@section('title',__('text.Search'))
@push('css')
    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>
@endpush
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="wrap-breadcrumb my-5" >
                <ol class="breadcrumb w-100 bg-white">
                    <li class="breadcrumb-item  active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
                    <li class="breadcrumb-item" aria-current="page">{{__('text.Search')}}</li>
                </ol>
            </div>

          <x-front.products.search :products="$products" />

        </div>
        <!-- end container-fluid -->

    </div>
    <!-- end content -->
@endsection
@push('script')
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
