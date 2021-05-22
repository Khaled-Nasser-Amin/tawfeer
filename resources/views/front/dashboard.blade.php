@extends('front.layouts.header')
@section('title',__('text.Home'))
@push('css')
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/owl.carousel.min.css')}}">

    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>
@endpush
@section('content')
    @livewire('front.dashboard.latest-products')
    @livewire('front.dashboard.special-products')
    @livewire('front.dashboard.highest-products')
    @livewire('front.dashboard.all-products')
@endsection
@push('script')
    @livewireScripts
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>

@endpush
