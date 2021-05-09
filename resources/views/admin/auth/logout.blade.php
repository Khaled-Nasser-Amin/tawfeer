@extends('admin.layouts.app')
@section('title',__('text.Logout'))
@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="text-center account-logo-box" style="background-image:url('/images/icons/logoTawfeer.png');background-size:cover; height:220px">
                            <div class="mt-2 mb-2">
                            </div>
                        </div>
                        <div class="card-body text-white bg-dark">

                            <div class="text-center">
                                <div class="checkmark mb-3">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                                        <circle class="path circle" fill="none" stroke="#4bd396" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                                        <polyline class="path check" fill="none" stroke="#4bd396" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                                    </svg>
                                </div>

                                <h4 class="text-white">{{__('text.See You Again')}} !</h4>

                                <p class="text-white">{{__('text.You are now successfully sign out')}}.</p>
                                <p class="text-muted">{{__('text.Return to')}} <a href="{{route('index')}}" class="text-primary mx-1">{{__('text.Log In')}}</a></p>

                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
