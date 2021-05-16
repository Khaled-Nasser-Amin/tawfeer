<div class="row justify-content-center">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
        <div class=" main-content-area">
            <div class="wrap-login-item ">
                <div class="register-form form-item w-100">

                    @if (!session()->has('activeSetNewPassword'))
                        @if (!session()->has('activeCodeField'))
                            <form wire:submit.prevent="sendSMS" class="form-stl" name="frm-login" >
                            <div class="form-group">
                                <h3 class="form-title">{{__('text.Forget-Password')}}</h3>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label for="frm-login-uname">{{__('text.Phone Number')}}</label>
                                <input type="text" id="frm-login-uname" wire:model="phone" class="form-control  {{$errors->has('phone') ? 'is-invalid' : ''}}" name="phone" placeholder="{{__('text.Type your phone number')}}">
                                <x-general.input-error for="phone" />
                            </div>
                            <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled" >{{__('text.Submit')}}</button>
                        </form>
                        @else
                            <form wire:submit.prevent="activeSetNewPassword" class="form-stl" name="frm-login" >
                                <div class="row form-group">
                                    <div class=" w-100 row justify-content-between align-items-center">
                                        <h6 class="form-title px-3">{{__('text.Number Confirmation')}}</h6>
                                        <i class="hover-dark-text fa fa-times-circle" wire:click.prevent="cancel" style="color:#f59524;"></i>
                                    </div>
                                    <h6 class="form-subtitle w-100 px-3">{{ __("text.We have sent a verification code to your number")}} : {{session()->has('phone') ? session()->get('phone') : 'In valid number'}}</h6>

                                    <p  class=" px-3" wire:ignore>
                                        <span id="text" class="font-14">{{__('text.Code will expire after : ')}}</span>
                                        <span id="timerCount" class="font-weight-bold" style="color: #f59524"></span>
                                    </p>
                                    <script>
                                        let time={{session()->get('time')}};
                                        time=parseInt(time)+(5*60);
                                        let x= setInterval(function (){
                                            var now = new Date().getTime()/1000;
                                            var distance = time - now;
                                            var minutes = Math.floor((distance % ( 60 * 60)) / ( 60));
                                            var seconds = Math.floor((distance % (60)));
                                            $('#timerCount').html(minutes+':'+seconds)
                                            if (distance < 0) {
                                                clearInterval(x);
                                                $('#timerCount').empty()
                                                $('#text').addClass(['text-danger','font-weight-bold'])
                                                $('#text').html("{{__('text.CODE EXPIRED')}}");
                                            }
                                        },1000)

                                        window.addEventListener('refreshCode',function (e){
                                            $('#text').removeClass(['text-danger','font-weight-bold'])
                                            $('#text').html("{{__('text.Code will expire after : ')}}")
                                            time=parseInt(e.detail)+(5*60)
                                            let x= setInterval(function (){
                                                var now = new Date().getTime()/1000;
                                                var distance = time - now;
                                                var minutes = Math.floor((distance % ( 60 * 60)) / ( 60));
                                                var seconds = Math.floor((distance % (60)));
                                                $('#timerCount').html(minutes+':'+seconds)
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    $('#timerCount').empty()
                                                    $('#text').addClass(['text-danger','font-weight-bold'])
                                                    $('#text').html("{{__('text.CODE EXPIRED')}}");

                                                }
                                            },1000)

                                        })

                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="frm-reg-lname">{{__('text.Code')}}*</label>
                                    <div class="row px-2">
                                        <input type="text" wire:model="code" class="col-8 form-control  {{$errors->has('code') ? 'is-invalid' : ''}}" placeholder="######">
                                        <a wire:click.prevent="resend" class="hover-dark-text col-4 row justify-content-center align-items-center" style="color: #f59524;">{{__('text.Resend?')}}</a>
                                    </div>

                                    <x-general.input-error for="code" />
                                </div>
                                <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled" >{{__('text.Submit')}}</button>
                             </form>
                        @endif
                    @else
                        <form wire:submit.prevent="updatePassword" class="form-stl" name="frm-login" >
                            <div class="form-group">
                                <h3 class="form-title">{{__('text.Set New Password')}}</h3>
                                <hr>
                            </div>
                            <div class="form-group">
                                    <label for="frm-reg-pass">{{__('text.New Password')}}*</label>
                                    <input type="password" wire:model="password"   class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"  placeholder="{{__('text.New Password')}}">
                                    <x-general.input-error for="password" />
                            </div>
                            <div class="form-group">
                                <label for="frm-reg-cfpass">{{__('text.Confirm Password')}}*</label>
                                <input type="password" wire:model="password_confirmation"   class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" placeholder="{{__('text.Confirm Password')}}">
                                <x-general.input-error for="password_confirmation" />
                            </div>

                            <button class="btn btn-sign d-block mx-auto"  wire:loading.attr="disabled" >{{__('text.Submit')}}</button>

                        </form>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
