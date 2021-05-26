<div wire:ignore.self id="EditModel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="control-label">{{__('text.Name')}}</label>
                                <input type="text" wire:model="name" class="form-control" id="name"  placeholder="@lang('text.Model Name')">
                                <x-general.input-error for="name" />
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="parent" class="control-label">{{__('text.Parent Category')}}</label>
                            <select class="form-control" name="parent" id="parent" wire:model="cate_id">
                                <option value="" selected>{{__('text.Select Category')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en}}</option>
                                @endforeach
                            </select>
                            <x-general.input-error for="parent" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">{{__('text.Close')}}</button>
                <button type="button" class="btn btn-info waves-effect waves-light" wire:click.prevent="update">{{__('text.Submit')}}</button>
            </div>
        </div>
    </div>
</div>

