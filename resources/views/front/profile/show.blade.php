@extends('front.layouts.header')
@section('title',__('text.Profile'))
@push('css')
    @livewireStyles
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
@endpush
@section('content')
    <div class="wrap-breadcrumb my-5" >
        <ol class="breadcrumb w-100 bg-white">
            <li class="breadcrumb-item"><a href="{{route('front.dashboard')}}" class="text-black-50">{{__('text.Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('text.Profile')}}</li>
        </ol>
    </div>

    <div>
        @livewire('front.profile.update-profile-information-form')

        <x-general.section-border />

        @livewire('front.profile.update-password-form')

        <x-general.section-border />


        @livewire('front.profile.logout-other-browser-sessions-form')

        <x-general.section-border />

        @livewire('front.profile.delete-user-form')
    </div>
@endsection
@push('script')
    @livewireScripts

    <script>
        window.livewire.on('refresh-navbar',route=>{
            $.ajax({
                'url':route,
                'method':'get',
                success:function (result){
                    let navbar=$('.topbar-menu-area');
                    navbar.empty();
                    navbar.html($('.topbar-menu-area',result).html());
                }
            })
        })
    </script>

@endpush


