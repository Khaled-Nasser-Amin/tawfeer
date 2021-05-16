@extends('front.layouts.header')
@section('title',__('text.Forget-Password'))
@push('css')
    @livewireStyles
@endpush
@section('content')
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{__('text.Forget-Password')}}</li>
        </ol>
    </div>

    @livewire('front.auth.forget-password')
@endsection
@push('script')
    @livewireScripts
@endpush
