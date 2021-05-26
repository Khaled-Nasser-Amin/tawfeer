
<div class="card-box ">
    <input type="text" class="form-control col-4 mb-4" placeholder="{{__('text.Search')}}..." wire:model="search">
    <table  class="table table-striped text-dark table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th>{{__('text.Image')}}</th>

            <th>{{__('text.Name_ar')}}</th>
            <th>{{__('text.Name_en')}}</th>
            <th>{{__('text.Slug')}}</th>
            {{--<th>{{__('text.Parent Category')}}</th>--}}
            <th>{{__('text.Action')}}</th>
        </tr>
        </thead>

        <tbody>
        @forelse($categories as $category)
            <tr>
                    <td>
                        <a class="text-dark" href="/admin/category/{{$category->id}}-{{\Illuminate\Support\Str::slug($category->slug)}}">
                            <div class="inbox-item-img">
                                <img style="width: 50px;height: 50px" class="img-thumbnail" src="{{$category->image}}" alt="">
                            </div>
                        </a>
                    </td>
                    <td><a class="text-dark" href="/admin/category/{{$category->id}}-{{\Illuminate\Support\Str::slug($category->name_ar)}}">{{$category->name_ar}}</a></td>
                    <td><a class="text-dark" href="/admin/category/{{$category->id}}-{{\Illuminate\Support\Str::slug($category->name_en)}}">{{$category->name_en}}</a></td>
                    <td><a class="text-dark" href="/admin/category/{{$category->id}}-{{$category->slug}}">{{$category->slug}}</a></td>

                    {{--  @if($category->parent_category)
                        <td>
                            <div class="inbox-item-img">
                                <a class="text-dark" href="/admin/category/{{$category->parent_category->id}}-{{$category->parent_category->slug}}">
                                    <img style="width: 50px;height: 50px" class="img-thumbnail" src="{{$category->parent_category->image}}" alt="parentImage">
                                    {{app()->getLocale() == 'ar' ? $category->parent_category->name_ar : $category->parent_category->name_en}}
                                </a>
                            </div>
                        </td>
                    @else
                        <td>Root</td>
                    @endif--}}

                    <td>
                        <button class="btn btn-secondary waves-effect waves-light btn-sm" wire:click="edit({{$category->id}})" data-toggle="modal" data-target="#EditCategory">
                            {{__('text.Edit')}}
                        </button>
                        <button type="button" wire:click="confirmDelete({{$category->id}})" class="btn btn-danger waves-effect waves-light btn-sm">
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
