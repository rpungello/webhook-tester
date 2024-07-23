<div>
    <x-slot:title>{{ __('Update Profile') }}</x-slot:title>

    <div class="w-screen flex items-center justify-center">
        <form class="flex flex-col space-y-4" wire:submit.prevent="save">
            @csrf

            <h1 class="font-bold text-xl text-center">{{ __('Update Profile') }}</h1>

            <!-- Name -->
            <x-input name="name" type="text" label="{{ __('Name') }}" icon="o-user" error-field="name" class="min-w-96"
                     wire:model="name"/>

            <!-- Email address -->
            <x-input name="email" type="email" label="{{ __('Email') }}" icon="o-at-symbol" error-field="email"
                     class="min-w-96" wire:model="email"/>

            <!-- Password -->
            <x-input name="password" type="password" label="{{ __('Password') }}" icon="o-key" error-field="password"
                     class="min-w-96" wire:model="password"/>

            <!-- Password confirmation -->
            <x-input name="password_confirmation" type="password" label="{{ __('Confirm Password') }}" icon="o-key"
                     error-field="password_confirmation" class="min-w-96" wire:model="password_confirmation"/>

            <x-button type="submit" class="btn btn-primary" label="{{ __('Save') }}"/>
        </form>
    </div>
</div>
