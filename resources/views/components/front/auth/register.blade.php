<div class="row justify-content-center">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="register-form form-item w-100">

                    @if (!session()->has('activeCodeField'))
                        <form wire:submit.prevent="store" class="form-stl" name="frm-login" >
                            <div class="row form-group">
                                <h3 class="form-title">{{__('text.Create an account')}}</h3>
                                <h4 class="form-subtitle">{{__("text.Personal infomation")}}</h4>
                            </div>
                            <div class="form-group">
                                <label for="frm-reg-lname">{{__('text.Name')}}*</label>
                                <input type="text" wire:model="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" placeholder="{{__('text.Full Name')}}*">
                                <x-general.input-error for="name" />
                            </div>
                            <fieldset class="wrap-input">
                                <label for="frm-reg-email">{{__('text.Phone Number')}}*</label>
                                <input type="text" wire:model="phone"  class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" placeholder="{{__('text.Phone Number')}}">
                                <x-general.input-error for="phone" />
                            </fieldset>
                            <fieldset class="wrap-title">
                                <h3 class="form-title">{{__('text.Login Information')}}</h3>
                            </fieldset>

                            <div class="row w-100 mx-0 px-0">
                                <fieldset class="wrap-input item-width-in-half left-item mb-4 mx-0 w-50">
                                    <label for="frm-reg-pass">{{__('text.Password')}}*</label>
                                    <input type="password" wire:model="password"   class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"  placeholder="{{__('text.Password')}}">
                                    <x-general.input-error for="password" />
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half mb-4 mx-0 w-50">
                                    <label for="frm-reg-cfpass">{{__('text.Confirm Password')}}*</label>
                                    <input type="password" wire:model="password_confirmation"   class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" placeholder="{{__('text.Confirm Password')}}">
                                    <x-general.input-error for="password_confirmation" />
                                </fieldset>
                            </div>

                            <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled">{{__('text.Register')}}</button>
                        </form>
                    @else
                        <form wire:submit.prevent="store" class="form-stl" name="frm-login" >
                            <div class="row form-group">
                                <h3 class="form-title">{{__('text.Account Confirmation')}}</h3>
                                <h4 class="form-subtitle">{{ __("text.We have sent a verification code to your number")}} : {{session()->has('data.phone') ? session()->get('data.phone') : 'In valid number'}}</h4>
                            </div>
                            <div class="form-group">
                                <label for="frm-reg-lname">{{__('text.Code')}}*</label>
                                <input type="text" wire:model="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" placeholder="######">
                                <x-general.input-error for="code" />
                            </div>
                            <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled">{{__('text.Login')}}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div><!--end main products area-->
    </div>
</div><!--end row-->
