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

            <!-- Email -->
            <div class="form-group">
                <x-general.label for="email" value="{{ __('text.Email') }}" />
                <x-general.input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" wire:model.defer="state.email" />
                <x-general.input-error for="email" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
		<div class="d-flex align-items-baseline">
			<x-general.button>
				{{ __('text.Save') }}
			</x-general.button>
		</div>
    </x-slot>
</x-general.form-section>
