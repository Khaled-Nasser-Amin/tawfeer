@extends('front.layouts.header')
@section('title',__('text.Login'))
@push('css')
@endpush
@section('content')
     <div class="wrap-breadcrumb my-5" >
            <ol class="breadcrumb w-100 bg-white">
                <li class="breadcrumb-item  active"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{__('text.Login')}}</li>
            </ol>
     </div>


   @livewire('front.auth.login')

@endsection
@push('script')
@endpush
