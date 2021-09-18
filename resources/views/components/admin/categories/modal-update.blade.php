<div wire:ignore.self id="EditCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">{{__('text.Category')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_ar" class="control-label">{{__('text.Name_ar')}}</label>
                                <input wire:model="name_ar" type="text" class="form-control" id="name_ar"  >
                                <x-general.input-error for="name_ar" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_en" class="control-label">{{__('text.Name_en')}}</label>
                                <input type="text" class="form-control" id="name_en" wire:model="name_en">
                                <x-general.input-error for="name_en" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mb-4 mx-2">
                            <label>{{__('text.Add Image')}}</label>
                            <input type="file"  wire:model="image"  data-height="210" />
                            <br>
                            <x-general.input-error for="image" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin" wire:ignore>
                                <label for="slug" class="control-label">{{__('text.Slug')}}</label>
                                <input type="text" class="form-control" id="slug"  wire:model="slug">
                                <x-general.input-error for="slug" />
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">{{__('text.Close')}}</button>
                <button type="button" class="btn btn-info waves-effect waves-light" wire:click.prevent="update" wire:loading.attr="disabled" wire:target="image">{{__('text.Submit')}}</button>
            </div>
        </div>
    </div>
</div>

