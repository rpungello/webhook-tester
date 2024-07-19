<?php

namespace App\Livewire;

use App\Models\Request;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Home extends Component
{
    public ?Request $selectedRequest = null;

    public function render(): View
    {
        return view('livewire.home', [
            'requests' => auth()->user()->requests()->latest()->get(),
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
}
