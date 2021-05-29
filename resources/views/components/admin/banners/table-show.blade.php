<div class="col-12">
    <input type="text" wire:model="search" class="form-control col-4 my-3" placeholder="{{__('text.Search')}}...">
    <table class="table table-striped table-dark col-12">

        <tr>
            <th>{{__('text.Image')}}</th>
            <th>{{__('text.Name')}}</th>
            <th>{{__('text.Url')}}</th>
            <th>{{__('text.Show in')}}</th>
            <th>{{__('text.Action')}}</th>
        </tr>
        @forelse ($banners as $banner)
            <tr>
                <td><img src="{{$banner->image}}"  style="width: 150px;height: 60px" alt="banner-image"></td>
                <td>{{$banner->name}}</td>
                <td>{{$banner->url}}</td>
                <td>{{$banner->show_in}}</td>
                <td><button class="btn btn-secondary"  data-toggle="modal" data-target="#EditBanner" wire:click.prevent="edit({{$banner->id}})">{{__('text.Edit')}}</button>
                    <button class="btn btn-danger" wire:click.prevent="confirmDelete({{$banner->id}})">{{__('text.Delete')}}</button>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">{{__('text.No Data Yet')}}</td></tr>
        @endforelse

    </table>

    {{$banners->links()}}
</div>
