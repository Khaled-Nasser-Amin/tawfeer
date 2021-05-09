<x-general.action-section>
    <x-slot name="title">
        {{ __('text.Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('text.Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div>
            {{ __('text.Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-3">
            <x-general.danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('text.Delete Account') }}
            </x-general.danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-general.dialog-modal wire:model="confirmingUserDeletion" class="mt-2">
            <x-slot name="title">
                {{ __('text.Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('text.Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}

                <div class="mt-2 w-md-75" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-general.input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('text.Password') }}"
                                 x-ref="password"
                                 wire:model.defer="password"
                                 wire:keydown.enter="deleteUser" />

                    <x-general.input-error for="password" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-general.secondary-button wire:click="$toggle('confirmingUserDeletion')"
                                        wire:loading.attr="disabled">
                    {{ __('text.Cancel') }}
                </x-general.secondary-button>

                <x-general.danger-button wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('text.Delete Account') }}
                </x-general.danger-button>
            </x-slot>
        </x-general.dialog-modal>
    </x-slot>

</x-general.action-section>
