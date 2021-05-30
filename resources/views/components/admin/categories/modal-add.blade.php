<div wire:ignore.self id="AddNewCategory"  class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title mt-0">{{__('text.Category')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form  id="addNewCat">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_ar1" class="control-label">{{__('text.Name_ar')}}</label>
                                <input type="text" wire:model="name_ar" class="form-control" id="name_ar1"  placeholder="كيا">
                                <x-general.input-error for="name_ar" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_en1" class="control-label">{{__('text.Name_en')}}</label>
                                <input type="text" wire:model="name_en" class="form-control" id="name_en1" placeholder="Kia">
                                <x-general.input-error for="name_en" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-4">
                            <label>{{__('text.Add Image')}}</label>
                            <input type="file"  wire:model="image"  data-height="210" />
                            <x-general.input-error for="image" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="slug1" class="control-label">{{__('text.Slug')}}</label>
                                <input type="text" wire:model="slug" class="form-control" id="slug1" placeholder="Kia-كيا">
                                <x-general.input-error for="slug" />
                            </div>

                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="form-group col-md-6">
                            <label for="parent" class="control-label">{{__('text.Parent Category')}}</label>
                            <select class="form-control" wire:model="parent">
                                <option value="" selected>{{__('text.Main Category')}}</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en}}</option>
                                @endforeach
                            </select>
                            <x-general.input-error for="parent" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type" class="control-label">{{__('text.Show As')}}</label>
                            <select class="form-control" name="type"  wire:model="type">
                                <option selected value="">~~{{__('text.Choose Show')}}~~</option>
                                <option value="Category">{{__('text.Category')}}</option>
                                <option value="Product">{{__('text.Product')}}</option>
                            </select>
                            <x-general.input-error for="type" />
                        </div>
                    </div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">{{__('text.Close')}}</button>
                <button type="button" class="btn btn-info waves-effect waves-light" wire:click.prevent="store">{{__('text.Save')}}</button>
            </div>
        </div>
    </div>
</div>
