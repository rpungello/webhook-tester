<div class="flex flex-row">
    <script>
        function copyText(field, value, isBase64 = false) {
            if (isBase64) {
                value = atob(value);
            }
            navigator.clipboard.writeText(value);

            Swal.fire({
                icon: 'info',
                title: field + ' copied to clipboard',
                timer: 3000,
                showCloseButton: false,
                position: 'top-end',
                showConfirmButton: false,
                toast: true,
            });
        }
    </script>

    <!-- Sidebar list of requests -->
    <aside class="w-96">
        <div class="px-4 flex flex-row items-center space-x-4">
            <div class="w-full">
                <x-input wire:model.live="search" icon="o-magnifying-glass" class="w-full"/>
            </div>
            <x-button type="button" wire:click="deleteAll()" class="btn-outline btn-error" icon="o-trash"/>
        </div>
        <div class="request-list-height" wire:loading.class="animate-pulse">
            @foreach($requests as $request)
                {{-- Hide trashed items as it takes time for Scout to pick up on the fact that an item has been deleted --}}
                @if(!$request->trashed())
                    <x-list-item class="{{ $this->isActive($request) ? 'bg-base-200' : '' }}" :item="$request">
                        <!-- Request method -->
                        <x-slot:avatar>
                            <x-badge :value="$request->method" class="w-16 badge-info"/>
                        </x-slot:avatar>

                        <!-- Request path -->
                        <x-slot:value>
                            {{ $request->path }}
                        </x-slot:value>

                        <!-- Request time -->
                        <x-slot:subValue>
                            {{ $request->created_at->diffForHumans() }}
                        </x-slot:subValue>

                        <!-- Remove button -->
                        <x-slot:actions>
                            <x-button type="button" wire:click="selectRequest({{ $request }})" class="btn-primary btn-xs {{ $this->isActive($request) ? '' : 'btn-outline' }}" icon="o-eye"/>
                            <x-button type="button" wire:click="delete({{ $request }})" class="btn-error btn-xs btn-outline" icon="o-trash"/>
                        </x-slot:actions>
                    </x-list-item>
                @endif
            @endforeach
        </div>
        `

        <div class="px-4">
            {{ $requests->links() }}
        </div>
    </aside>

    @isset($selectedRequest)
        <!-- Information about selected request -->
        <div class="flex-grow flex flex-row px-4">
            <!-- Request details -->
            <div class="w-1/2 main-height">
                <h1>{{ __('Request Data') }}</h1>
                @foreach($selectedRequest->toList() as $field)
                    <x-list-item :item="$field" value="name" sub-value="value">
                        <x-slot:actions>
                            <x-button onclick="copyText('{{ $field['name'] }}', '{{ $field['value'] }}')" icon="o-clipboard" class="" />
                        </x-slot:actions>
                    </x-list-item>
                @endforeach

                @isset($selectedRequest->body)
                    <div class="mt-8 flex flex-row items-center space-x-4">
                        <h1>{{ __('Body') }}</h1>
                        <x-button onclick="copyText('Body', '{{ base64_encode($selectedRequest->body) }}', true)" icon="o-clipboard" class="" />
                    </div>
                    <p class="whitespace-pre-wrap">{!! $selectedRequest->getFormattedBody() !!}</p>
                @endisset
            </div>

            <!-- Headers -->
            <div class="w-1/2 main-height">
                <h1>{{ __('Headers') }}</h1>
                @foreach($selectedRequest->headers as $header)
                    <x-list-item :item="$header" value="name" sub-value="value">
                        <x-slot:actions>
                            <x-button onclick="copyText('{{ $header->name }}', '{{ $header->value }}')" icon="o-clipboard" class="" />
                        </x-slot:actions>
                    </x-list-item>
                @endforeach
            </div>
        </div>
    @endisset
</div>
