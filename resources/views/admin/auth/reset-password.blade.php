@extends('admin.layouts.app')
@section('title','Recover Password | Zircos - Responsive Bootstrap 4 Admin Dashboard')
@section('content')
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="text-center account-logo-box">
                            <div class="mt-2 mb-2">
                                <a href="{{route('login')}}" class="text-success">
                                    <span><img src="{{asset('images/logo.png')}}" alt="" height="36"></span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-4">
                                <p class="text-muted mb-0">Enter your New password and password confirmation </p>
                            </div>

                            <form action="{{route('changePassword')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="password" required="" placeholder="password">
                                        <x-general.input-error for="password" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="confirm password">
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center mt-2 row">
                                    <div class="col-12">
                                        <button class="btn width-md btn-bordered btn-danger waves-effect waves-light" type="submit">Confirm
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div>

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection
