<?php

namespace App\Livewire\Projects;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ListProjects extends Component
{
    #[Validate(['required'])]
    public string $newProjectName = '';

    public function render(): View
    {
        return view('livewire.projects.list-projects', [
            'projects' => $this->getProjects(),
        ]);
    }

    public function create(): void
    {
        $this->validate();

        $project = auth()->user()->projects()->create([
            'name' => $this->newProjectName,
        ]);

        $this->redirectRoute('projects.edit', [
            'project' => $project->getKey(),
        ]);
    }

    private function getProjects(): Collection
    {
        return auth()->user()->projects()->orderBy('name')->get();
    }
}
