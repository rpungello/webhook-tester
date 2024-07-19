<x-container>
    <div>
        <h1>{{ __('Edit Project') }}</h1>
        <h2 class="mb-4">{{ $project->name }}</h2>
        <x-form wire:submit="save">
            <x-input label="{{ __('Name') }}" wire:model="name"/>
            <x-input type="number" label="{{ __('Response Code') }}" wire:model="response_code"/>
            <x-input label="{{ __('Response Content Type') }}" wire:model="response_content_type"/>
            <x-textarea label="{{ __('Response Body') }}" rows="10" wire:model="response_body"/>

            <x-button type="submit" label="{{ __('Save') }}"/>
        </x-form>
    </div>
</x-container>
