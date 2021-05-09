<div class="col-sm-12 ">
    <form class="row justify-content-center" method="get" action="{{--{{route('products.index')}}--}}">
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label for="field-1" class="control-label">{{__('text.Category Name')}}</label>
                <select id="field-1" class="form-control" wire:model="category">
                    <option value="">{{__('text.Search By Category')}}...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar: $category->name_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label for="field-2" class="control-label">{{__('text.Filter Products')}}</label>
                <select id="field-2" class="form-control" wire:model="filterProducts">
                    <option value="">-- {{__('text.Filter Products')}} --</option>
                    <option value="myProducts">{{__('text.My Products')}}</option>
                    <option value="allProducts">{{__('text.All Products')}}</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label for="field-2" class="control-label">{{__('text.Product Name')}}</label>
                <input type="text" wire:model="searchText" class="form-control" id="field-2" placeholder="{{__('text.Product Name')}}...">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                <label for="field-3" class="control-label">{{__('text.Price')}}</label>
                <input type="text" wire:model="price" class="form-control" id="field-3" placeholder="{{__('text.Search By Price')}}">
            </div>
        </div>

    </form>
</div>
