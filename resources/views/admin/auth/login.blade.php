@extends('admin.layouts.app')
@section('title','Login | Zircos - Responsive Bootstrap 4 Admin Dashboard')
@section('content')
<div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                @if (session('status'))
                    <div class="alert alert-success mb-3 rounded-0" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="text-center account-logo-box">
                            <div class="mt-2 mb-2">
                                 <a class='btn btn-secondary waves-effect waves-light' rel="alternate" href="{{App::getLocale() == 'en' ? LaravelLocalization::getLocalizedURL('ar', null, [], true) :   LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                     {{ app()->getLocale() == 'ar'? 'English' : 'العربية' }}
                                 </a>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('admin.partials.errors')
                            <form action="{{route('login')}}" method='post'>
                                @csrf
                                <div class="form-group">
                                    <input class="form-control mb-1" type="text" name='email' id="username" required="" value="{{old('email')}}" placeholder="{{__('text.Username')}}">
                                     <x-general.input-error for="email" />
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="password" name='password' required="" id="password" placeholder="{{__('text.Password')}}">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox checkbox-success">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                        <label class="custom-control-label" for="checkbox-signin">{{__('text.Remember me')}}</label>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-4 pt-2">
                                    <div class="col-sm-12">
                                        <a href="{{route('viewForget')}}" class="text-muted"><i class="fa fa-lock mr-1"></i> {{__('text.Forgot your password?')}}</a>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center mt-2">
                                    <div class="col-12">
                                        <button class="btn width-md btn-bordered btn-danger waves-effect waves-light" type="submit">{{__('text.Log In')}}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection

