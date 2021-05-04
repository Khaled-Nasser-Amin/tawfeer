<div wire:ignore.self class="modal fade" id="groupOfProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('text.Select Group of Products')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="addSelectProduct">
                    <div class="form-group">
                        <button type="button" wire:click.prevent="addProduct" class="btn btn-success btn_AddMore">
                            {{__('text.Add Product')}}</button>
                    </div>
                    @forelse($productsIndex as $index => $value)
                        <div class="form-group row justify-content-between" >
                            <div class="col-5">
                                <select  wire:model='productsIndex.{{$index}}.product_id' class='form-control d-block'>
                                    <option value="">{{__('text.Choose Product')}}</option>
                                    @forelse($products as $product)
                                        <option value='{{$product->id}}'>{{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-general.input-error for="productsIndex.{{$index}}.product_id" />
                            </div>
                            <div class="col-5">
                                <input type="text" wire:model="productsIndex.{{$index}}.quantity" class="form-control d-block">
                                <x-general.input-error for="productsIndex.{{$index}}.quantity" />
                            </div>

                            <div class="col-2">
                                <button type="button" wire:click="deleteProduct({{$index}})" class="btn btn-danger btn_remove">{{__("text.Delete")}}</button>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
