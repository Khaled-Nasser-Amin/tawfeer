<div class="col-lg-9">
    <!-- end m-t-30 -->
    <h6>{{__('text.Products')}}</h6>
    <div class="card-box table-responsive">
        <input wire:model="search" type="text" class="form-control mb-3 col-4" placeholder="{{__('text.Search')}}...">
        <table id="datatable-buttons" class="table table-striped text-dark table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>{{__('text.Image')}}</th>
                <th>{{__('text.Name_ar')}}</th>
                <th>{{__('text.Name_en')}}</th>
                <th>{{__('text.Price')}}</th>
                <th>{{__('text.Sale')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        <a wire:click="searchByProduct({{$product->price}},'{{$category->id}}','{{$product->name_ar}}')" href="/admin/products">
                            <div class="inbox-item-img">
                                <img style="width: 50px;height: 50px" class="img-thumbnail" src="{{$product->image}}" alt="{{__('text.Image')}}">
                            </div>
                        </a>
                    </td>
                    <td>{{$product->name_ar}}</td>
                    <td>{{$product->name_en}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->sale}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{__('text.The category does not have any product yet')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{$products->links()}}
    </div>
    <!-- end card-box -->

</div>
