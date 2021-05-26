@section('title',__('text.Models'))
@push('css')
    @livewireStyles
    <link href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        svg{
            width: 20px;
            height: 20px;
        }
    </style>

@endpush
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <x-admin.general.page-title>
                <li class="breadcrumb-item active">{{__('text.Models')}}</li>
                <li class="breadcrumb-item active"><a href="{{route('admin.index')}}">{{__('text.Dashboard')}}</a></li>
                <x-slot name="title">
                    <h4 class="page-title">{{__('text.Models')}}</h4>
                </x-slot>
            </x-admin.general.page-title>

            <!-- End row -->
            @include('admin.partials.success')
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <x-admin.models.modal-add :categories="$categories" />
                    <x-admin.models.modal-update :categories="$categories" />
                    <!-- Responsive modal -->
                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#AddNewModel">
                        {{__('text.Add New Model')}}
                    </button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <x-admin.models.table-show :models="$models" :categories="$categories" />
                    {{$models->links()}}
                </div>
            </div>
        </div>
    </div>

@push('script')
    <script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>
    @livewireScripts
    <script>
    window.Livewire.on('addNewModel',()=>{
        $('#AddNewModel').modal('hide');
    })
    window.Livewire.on('updatedModel',()=>{
        $('#EditModel').modal('hide');
    })

    //event fired to livewire called delete
    window.Livewire.on('confirmDelete',function (e) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger mx-2'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: '{{__("text.Are you sure?")}}',
            text: '{{__("text.You won't be able to revert this!")}}',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{__("text.Yes, delete it!")}}',
            cancelButtonText: '{{__("text.No, cancel!")}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value == true) {
                window.Livewire.emit('delete',e)
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '{{__("text.Cancelled")}}',
                    '{{__("text.Your imaginary file is safe :)")}}',
                    'error'
                )
            }
        })

    })

    </script>



@endpush

