<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Profile extends Component
{
    use LivewireAlert;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'email', 'max:255'])]
    public string $email = '';

    #[Validate(['confirmed', 'string', 'max:255'])]
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function render(): View
    {
        return view('livewire.profile');
    }

    public function save(): void
    {
        auth()->user()->update(
            array_filter(
                $this->validate()
            )
        );

        $this->alert('success', 'Profile updated successfully!');
    }
}
