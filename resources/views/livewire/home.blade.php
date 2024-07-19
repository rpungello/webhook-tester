<div class="flex flex-row">
    <!-- Sidebar list of requests -->
    <aside class="w-96 overflow-y-scroll main-height">
        @foreach($requests as $request)
            <x-list-item class="cursor-pointer {{ $this->isActive($request) ? 'bg-base-200' : '' }}" :item="$request" wire:click="selectRequest({{ $request }})">
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
            </x-list-item>
        @endforeach
    </aside>

    @isset($selectedRequest)
        <!-- Information about selected request -->
        <div class="flex-grow flex flex-row px-4">
            <!-- Request details -->
            <div class="w-1/2 main-height">
                <h1>{{ __('Request Data') }}</h1>
                @foreach($selectedRequest->toList() as $field)
                    <x-list-item :item="$field" value="name" sub-value="value" />
                @endforeach

                @isset($selectedRequest->body)
                    <h1 class="mt-8">{{ __('Body') }}</h1>
                    <p class="whitespace-pre-wrap">{!! $selectedRequest->getFormattedBody() !!}</p>
                @endisset
            </div>

            <!-- Headers -->
            <div class="w-1/2">
                <h1>{{ __('Headers') }}</h1>
                @foreach($selectedRequest->headers as $header)
                    <x-list-item :item="$header" value="name" sub-value="value" />
                @endforeach
            </div>
        </div>
    @endisset
</div>
