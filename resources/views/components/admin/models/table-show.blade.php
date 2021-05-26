
<div class="card-box ">
    <div class="col-12 row justify-content-center">
        <input type="text" class="form-control col-4 mb-4" placeholder="{{__('text.Search')}}..." wire:model="search">
        <select class="form-control col-4 mx-2"  wire:model="filter_cate_id">
            <option value="" selected>{{__('text.Select Category')}}</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en}}</option>
            @endforeach
        </select>
    </div>

    <table  class="table table-striped text-dark table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th>{{__('text.Index')}}</th>
            <th>{{__('text.Name')}}</th>
            <th>{{__('text.Category')}}</th>
            <th>{{__('text.Action')}}</th>
        </tr>
        </thead>

        <tbody>
        @forelse($models as $model)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$model->name}}</td>
                <td>
                    <a class="text-dark" href="/admin/category/{{$model->category->id}}-{{\Illuminate\Support\Str::slug($model->category->slug)}}">
                        <div class="inbox-item-img">
                            <img style="width: 100px;height: 50px" class="img-thumbnail" src="{{$model->category->image}}" alt="">
                            {{app()->getLocale() == 'ar' ? $model->category->name_ar : $model->category->name_en}}

                        </div>
                    </a>
                </td>
                <td>
                    <button class="btn btn-secondary waves-effect waves-light btn-sm" wire:click="edit({{$model->id}})" data-toggle="modal" data-target="#EditModel">
                        {{__('text.Edit')}}
                    </button>
                    <button type="button" wire:click="confirmDelete({{$model->id}})" class="btn btn-danger waves-effect waves-light btn-sm">
                        {{__('text.Delete')}}
                    </button>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">{{__('text.No Data Yet')}}</td></tr>
        @endforelse

        </tbody>
    </table>
</div>
