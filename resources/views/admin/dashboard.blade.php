@extends('admin.layouts.appLogged')
@section('title',__('text.Dashboard'))
@push('css_en')
@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">{{__('text.AllProducts')}}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">{{__('text.AllProducts')}}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card widget-box-one border border-primary bg-soft-primary">
                        <div class="card-body">
                            <div class="float-right avatar-lg rounded-circle mt-3">
                                <i class="mdi mdi-car-hatchback font-30 widget-icon rounded-circle avatar-title text-primary"></i>
                            </div>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-weight-bold text-muted" title="Statistics">
                                    {{__('text.Categories')}}</p>
                                <h2><span data-plugin="counterup">{{$categories}}</span> </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card widget-box-one border border-warning bg-soft-warning">
                        <div class="card-body">
                            <div class="float-right avatar-lg rounded-circle mt-3">
                                <i class="mdi mdi-car-cruise-control font-30 widget-icon rounded-circle avatar-title text-warning"></i>
                            </div>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-weight-bold text-muted" title="User This Month">{{__('text.Spares')}}</p>
                                <h2><span data-plugin="counterup">{{$products}} </span> </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card widget-box-one border border-danger bg-soft-danger">
                        <div class="card-body">
                            <div class="float-right avatar-lg rounded-circle mt-3">
                                <i class="mdi mdi-account font-30 widget-icon rounded-circle avatar-title text-danger"></i>
                            </div>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-weight-bold text-muted" title="Statistics">
                                    {{__('text.Users')}}</p>
                                <h2><span data-plugin="counterup">{{$vendors}} </span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card widget-box-one border border-success bg-soft-success">
                        <div class="card-body">
                            <div class="float-right avatar-lg rounded-circle mt-3">
                                <i class="mdi mdi-car font-30 widget-icon rounded-circle avatar-title text-success"></i>
                            </div>
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-weight-bold text-muted" title="User Today">{{__('text.My Products')}}</p>
                                <h2><span data-plugin="counterup">{{$myProducts}}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

           {{-- <div class="row">
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Total Revenue</h4>

                        <div id="website-stats" style="height: 320px;" class="flot-chart"></div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Sales Analytics</h4>

                        <div class="float-right">
                            <div id="reportrange" class="form-control form-control-sm">
                                <i class="far fa-calendar-alt mr-1"></i>
                                <span></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="donut-chart">
                            <div id="donut-chart-container" class="flot-chart" style="height: 246px;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->--}}

        </div>
        <!-- end container-fluid -->

    </div>
@endsection
@push('js')

    <script src="{{asset('js/pages/dashboard_2.init.js')}}"></script>
@endpush

