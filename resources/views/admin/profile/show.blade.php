@extends('admin.layouts.appLogged')
@section('title','Profile')
@push('css')
    @livewireStyles
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
@endpush
@section('content')
    <div>
        @livewire('admin.profile.update-profile-information-form')

        <x-general.section-border />

        @livewire('admin.profile.update-password-form')

        <x-general.section-border />

        @livewire('admin.profile.two-factor-authentication-form')

        <x-general.section-border />

        @livewire('admin.profile.logout-other-browser-sessions-form')

        <x-general.section-border />

        @livewire('admin.profile.delete-user-form')
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
                    let navbar=$('.navRefresh');
                    navbar.empty();
                    navbar.html($('.navRefresh',result).html());
                }
            })
        })
    </script>

@endpush


