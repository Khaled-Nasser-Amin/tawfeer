<x-general.form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('text.Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('text.Update your account\'s Profile information and email address.') }}
    </x-slot>

    <x-slot name="form" >
        <x-general.action-message on="saved">
            {{ __('text.Saved.') }}
        </x-general.action-message>
        <!-- Profile Photo -->
            <div class="form-group" x-data="{photoName: null, photoPreview: null}">
                <!-- Profile Photo File Input -->
                <input type="file" hidden
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-general.label for="photo" value="{{ __('text.Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->image ?? 'https://ui-avatars.com/api/?name='.urlencode($this->user->name).'&color=7F9CF5&background=EBF4FF' }}" class="rounded-circle" height="80px" width="80px">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px">
                </div>

                <x-general.secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('text.Select A New Photo') }}
				</x-general.secondary-button>
                @if($this->user->getAttributes()['image'])
                    <x-general.secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('text.Remove Photo') }}
                    </x-general.secondary-button>
                @endif

                <x-general.input-error for="photo" class="mt-2" />
            </div>

        <div class="w-md-75">
            <!-- Name -->
            <div class="form-group">
                <x-general.label for="name" value="{{ __('text.Name') }}" />
                <x-general.input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model.defer="state.name" autocomplete="name" />
                <x-general.input-error for="name" />
            </div>
            <div class="form-group">
                <x-general.label for="phone" value="{{ __('text.Phone Number') }}" />
                <x-general.input id="phone" type="text" class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" wire:model.defer="state.phone" autocomplete="phone" />
                <x-general.input-error for="phone" />
            </div>

        </div>


        @if (session()->has('activeCodeField'))
            <div class="row form-group">
                <div class=" w-100 row justify-content-between align-items-center">
                    <h6 class="form-title px-3">{{__('text.Number Confirmation')}}</h6>
                    <i class="hover-dark-text fa fa-times-circle" wire:click.prevent="cancel" style="color:#efc82e;"></i>
                </div>
                <h6 class="form-subtitle w-100 px-3">{{ __("text.We have sent a verification code to your number")}} : {{session()->has('phone') ? session()->get('phone') : 'In valid number'}}</h6>

                <p  class=" px-3" wire:ignore>
                    <span id="text" class="font-14">{{__('text.Code will expire after : ')}}</span>
                    <span id="timerCount" class="font-weight-bold" style="color: #efc82e"></span>
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
                    <a wire:click.prevent="resend" class="hover-dark-text col-4 row justify-content-center align-items-center" style="color: #efc82e;">{{__('text.Resend?')}}</a>
                </div>

                <x-general.input-error for="code" />
            </div>
        @endif



    </x-slot>

    <x-slot name="actions">
		<div class="d-flex align-items-baseline">
			<x-general.button>
				{{ __('text.Save') }}
			</x-general.button>
		</div>
    </x-slot>
</x-general.form-section>
