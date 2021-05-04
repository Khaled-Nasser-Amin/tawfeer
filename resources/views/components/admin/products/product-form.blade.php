<form wire:submit.prevent="{{$action}}">
    <div class="row">
        <div class="col-lg-6">
            <div class="p-4">
                <div class="form-group">
                    <label for="name_ar"> {{__('text.Name_ar')}}</label>
                    <input type="text" wire:model="name_ar" class="form-control" id="name_ar" name="name_ar" placeholder='محرك' >
                    <x-general.input-error for="name_ar" />
                </div>
                <div class="form-group">
                    <label for="name_en"> {{__('text.Name_en')}}</label>
                    <input type="text" wire:model="name_en" class="form-control" id="name_en" name="name_en" placeholder="Motor" >
                    <x-general.input-error for="name_en" />
                </div>
                <div class="form-group">
                    <label for="slug">{{__('text.Slug')}}</label>
                    <input type="text" name="slug" wire:model="slug" class="form-control" id="slug" placeholder="motor-محرك">
                    <x-general.input-error for="slug" />
                </div>
                <div class="form-group">
                    <label for="YearOfManufacture">{{__('text.Year of Manufacture')}}</label>
                    <input type="text" wire:model="YearOfManufacture" name="YearOfManufacture" class="form-control" id="YearOfManufacture" >
                    <x-general.input-error for="YearOfManufacture" />
                </div>
                <div class="form-group">
                    <label for="phone">{{__('text.Phone Number')}}</label>
                    <input type="text" name="phone" wire:model="phone" class="form-control" id="phone" >
                    <x-general.input-error for="phone" />
                </div>
                <div class="form-group">
                    <label for="whatsapp">{{__('text.WhatsApp')}}</label>
                    <input type="text" wire:model="whatsapp" name="whatsapp" class="form-control" id="whatsapp" >
                    <x-general.input-error for="whatsapp" />
                </div>

                <div class="form-group">
                    <label for="Description_ar">{{__('text.Description_ar')}}</label>
                    <textarea wire:model="description_ar" class="form-control" name="description_ar" id="Description_ar" rows="5"></textarea>
                    <x-general.input-error for="description_ar" />
                </div>

            </div>
            <!-- end class p-20 -->

        </div>
        <!-- end col -->

        <div class="col-lg-6">
            <div class="p-4">
                <div class="form-group mb-4">
                    <label class="mb-3">{{__('text.Categories')}}</label>
                    <div class="row">
                        <div class="col-12 w-100 row">
                            @forelse($categories as $category)
                                <div class="checkbox checkbox-primary mb-3 col-4 w-50">
                                    <input wire:model="categoriesIds.{{$loop->index}}" id="checkbox-{{$category->id}}" type="checkbox" value="{{$category->id}}">
                                    <label for="checkbox-{{$category->id}}" class="mb-0">
                                        {{app()->getLocale() =='ar' ? $category->name_ar : $category->name_en}}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted">{{__('text.No categories yet')}}</p>
                            @endforelse

                        </div>
                        <x-general.input-error for="categoriesIds" />
                        <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>



            </div>
            <div class="form-group mb-4">
                <label>{{__('text.Product Image')}} </label>
                <input type="file" wire:model="image"  class="form-control" data-height="210" />
            </div>
            <x-general.input-error for="image" />
            <div class="form-group mb-4">
                <label>{{__('text.Gallery')}}</label>
                <input type="file" wire:model="groupImage" class="form-control"  multiple data-height="210" />
            </div>
            <x-general.input-error for="groupImage" />
            <div class="form-group">
                <label for="price">{{__('text.Price')}}</label>
                <input type="number" wire:model="price" class="form-control" id="price" name="price" autocomplete="none">
                <x-general.input-error for="price" />
            </div>
            <div class="form-group">
                <label for="sale">{{__('text.Sale')}}</label>
                <input type="number" wire:model="sale" class="form-control" value="0" id="sale"  name="sale" autocomplete="none">
                <x-general.input-error for="sale" />
            </div>
            <div class="form-group">
                <label for="Description_en">{{__('text.Description_en')}}</label>
                <textarea wire:model="description_en" class="form-control" name="description_en" id="Description_en" rows="5"></textarea>
                <x-general.input-error for="description_en" />
            </div>
            @if (!$product)
                <div class="form-group">
                    <label class="mb-2"> {{__('text.Type')}}</label>
                    <br/>
                    <div class="radio radio-info form-check-inline">
                        <input type="radio"  wire:model="type" id="single" value="single" name="type" checked>
                        <label for="single">  {{__('text.Single')}} </label>
                    </div>
                    <div class="radio radio-info form-check-inline">
                        <input wire:model="type" type="radio" id="group" value="group"  name="type">
                        <label for="group">  {{__('text.Group')}} </label>
                    </div>
                </div>
                <x-general.input-error for="type" />
            @endif
            <div class="col-12 w-100 mt-3 form-group" id="selectGroup">
                @if ($product && $product->type == 'group')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#groupOfProducts">Choose product</button>
                @elseif(!$product && $type == 'group')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#groupOfProducts">Choose product</button>
                @endif
            </div>
            <x-general.input-error for="productsIndex" />
            <br>
            <x-general.input-error for="productsIndex.*.product_id" />
            <br>
            <x-general.input-error for="productsIndex.*.quantity" />
            @if ($product && $product->type == 'group')
                <x-admin.products.modal-multi-products :products="$products" :productsIndex="$productsIndex" />
            @elseif(!$product)
                <x-admin.products.modal-multi-products :products="$products" :productsIndex="$productsIndex" />
            @endif
            <!-- end class p-20 -->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

    <div class="text-center">
        <button type="submit" class="btn btn-success waves-effect waves-light">{{__('text.Submit')}}</button>
    </div>
</form>
