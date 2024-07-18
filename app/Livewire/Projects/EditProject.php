<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class EditProject extends Component
{
    use LivewireAlert;

    public Project $project;
    #[Validate(['required', 'max:255'])]
    public string $name = '';

    #[Validate(['required', 'numeric', 'between:200,599'])]
    public int $response_code = Response::HTTP_OK;

    #[Validate(['string', 'nullable', 'max:255'])]
    public ?string $response_content_type = null;

    #[Validate(['string', 'nullable'])]
    public ?string $response_body = null;

    public function mount(): void
    {
        $this->authorize('view', $this->project);

        $this->name = $this->project->name;
        $this->response_code = $this->project->response_code;
        $this->response_content_type = $this->project->response_content_type;
        $this->response_body = $this->project->response_body;
    }

    public function render(): View
    {
        return view('livewire.projects.edit-project');
    }

    public function save(): void
    {
        $this->authorize('update', $this->project);

        if ($this->project->update($this->validate())) {
            $this->alert('success', 'Project updated successfully!');
        } else {
            $this->alert('error', 'Project could not be updated.');
        }
    }
}
