<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public ?Request $selectedRequest = null;

    public string $search = '';

    public function mount(): void
    {
        $this->updateRequests();
    }

    public function render(): View
    {
        return view('livewire.home', [
            'requests' => $this->paginateRequests(),
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
        // This doesn't actually need to do anything, we just need to trigger a Livewire update
    }

    private function paginateRequests(): Paginator
    {
        return Request::search($this->search)
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->simplePaginate(15);
    }
}
