@extends('front.layouts.header')
@section('title',__('text.Register'))
@push('css')
    @livewireStyles
@endpush
@section('content')
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('text.Register')}}</li>
        </ol>
    </div>

   @livewire('front.auth.register')
@endsection
@push('script')
    @livewireScripts
@endpush
