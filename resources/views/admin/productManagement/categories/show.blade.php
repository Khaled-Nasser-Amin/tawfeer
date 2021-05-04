@extends('admin.layouts.appLogged')
@section('title','Categories')
@push('css')
    @livewireStyles
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <style>
        svg{
            width: 20px;
            height: 20px;
        }

    </style>
@endpush
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <x-admin.general.page-title>
                <li class="breadcrumb-item"><a href="/admin/categories">{{__('text.Categories')}} </a></li>
                <li class="breadcrumb-item active"> {{__('text.Details')}}</li>
                <x-slot name="title">
                    <h4 class="page-title">{{__('text.Category Details')}}</h4>
                </x-slot>
            </x-admin.general.page-title>



            <!-- end page title -->

            <div class="property-detail-wrapper">
                <div class="row">

                    <x-admin.categories.category.category-details :category="$category" />

                    @livewire('admin.products-management.categories.category.products-table-for-category',["category" => $category->id])

                </div>
                <!-- end row -->
            </div>
            <!-- end property-detail-wrapper -->

        </div>
        <!-- end container-fluid -->

    </div>
@endsection

@push('script')
    @livewireScripts


@endpush
