<div class="row justify-content-center">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="login-form form-item form-stl">
                    <form name="frm-login" wire:submit.prevent="loginForm">
                        <fieldset class="wrap-title">
                            <h3 class="form-title">{{__('text.Log in to your account')}}</h3>
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-login-uname">{{__('text.Phone Number')}}</label>
                            <input type="text" id="frm-login-uname" wire:model="phone" class="form-control  {{$errors->has('phone') ? 'is-invalid' : ''}}" name="phone" placeholder="{{__('text.Type your phone number')}}">
                            <x-general.input-error for="phone" />
                        </fieldset>
                        <fieldset class="wrap-input">
                            <label for="frm-login-pass">{{__('text.Password')}}</label>
                            <input type="password" id="frm-login-pass" wire:model="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="************">
                            <x-general.input-error for="password" />
                        </fieldset>

                        <fieldset class="wrap-input">
                            <label class="remember-field">
                                <input name="rememberme" class="form-control" wire:model="check" id="rememberme" value="forever" type="checkbox"><span>{{__('text.Remember me')}}</span>
                            </label>
                            <br>
                            <a class="link-function left-position" href="{{route('front.forgetPassword')}}" title="Forgotten password?">{{__('text.Forgot your password?')}}</a>
                        </fieldset>
                        <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled" >{{__('text.Login')}}</button>
                    </form>
                </div>
            </div>
        </div><!--end main products area-->
    </div>
</div><!--end row-->
