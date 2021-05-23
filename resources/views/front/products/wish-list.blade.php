@extends('front.layouts.header')
@section('title',__('text.Wishlist'))
@push('css')
    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>

@endpush
@section('content')
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{__('text.Wishlist')}}</li>
        </ol>
    </div>

    <!-- all products -->
    @livewire('front.products.wish-list')


@endsection
@push('script')
@endpush
