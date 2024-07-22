<x-container>
    <script>
        function copyApiUrl() {
            const urlElement = document.getElementsByName("api_url")[0];

            urlElement.select();
            navigator.clipboard.writeText(urlElement.value);

            Swal.fire({
                icon: 'success',
                title: 'API URL copied to clipboard',
                timer: 3000,
                showCloseButton: false,
                position: 'top-end',
                showConfirmButton: false,
                toast: true,
            });
        }
    </script>
    <div>
        <h1>{{ __('Edit Project') }}</h1>
        <h2 class="mb-4">{{ $project->name }}</h2>
        <x-form wire:submit="save">
            <x-input name="name" label="{{ __('Name') }}" wire:model="name"/>
            <x-input name="response_code" type="number" label="{{ __('Response Code') }}" wire:model="response_code"/>
            <x-input name="response_content_type" label="{{ __('Response Content Type') }}" wire:model="response_content_type"/>
            <x-textarea name="response_body" label="{{ __('Response Body') }}" rows="10" wire:model="response_body"/>
            <x-input name="api_url" label="{{ __('API URL') }}" value="{{ $project->getApiUrl() }}" readonly>
                <x-slot:append>
                    <x-button icon="o-clipboard" onclick="copyApiUrl()" class="btn-outline btn-primary rounded-s-none" />
                </x-slot:append>
            </x-input>

            <x-button type="submit" label="{{ __('Save') }}"/>
        </x-form>
    </div>
</x-container>
