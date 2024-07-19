<x-container>
    <div>
        <x-slot:title>{{ __('Projects') }}</x-slot:title>

        @foreach($projects as $project)
            <x-list-item :item="$project" link="{{ route('projects.edit', $project) }}"/>
        @endforeach

        <x-form class="mt-8" wire:submit="create">
            <x-input label="{{ __('New project') }}" icon="o-document" wire:model="newProjectName"/>

            <x-button type="submit" label="{{ __('Create') }}"/>
        </x-form>
    </div>
</x-container>
