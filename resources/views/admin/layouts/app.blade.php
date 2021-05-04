<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
@include('admin.layouts.head')

<body>
<div id="wrapper">
    @yield('content')
    <!-- Page Content -->
</div>
<!-- App js -->
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/vendor.min.js')}}"></script>
@stack('js')
</body>
</html>
