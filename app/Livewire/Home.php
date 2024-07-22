<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Home extends Component
{
    public ?Request $selectedRequest = null;

    public function mount(): void
    {
        $this->updateRequests();
    }

    public function render(): View
    {
        return view('livewire.home', [
            'requests' => auth()->user()->requests()->latest()->simplePaginate(15)
        ]);
    }

    public function selectRequest(Request $request): void
    {
        $this->selectedRequest = $request;
    }

    public function isActive(Request $request): bool
    {
        return $this->selectedRequest?->id === $request->id;
    }

    #[On('echo:webhooks,WebhookReceivedEvent')]
    public function updateRequests(): void
    {
    }
}
