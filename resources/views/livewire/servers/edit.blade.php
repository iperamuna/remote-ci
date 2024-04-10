<?php

use App\Models\Project;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public ?Project $project;

    #[Rule('required|min:5')]
    public string $name;

    #[Rule('required|min:10')]
    public string $description;

    #[Rule('required')]
    public string $status = 'active';

    public function mount(Project $project): void
    {
        $this->fill($project);
    }


    public function save()
    {
        $this->project->update($this->validate());

        $this->success('Project Updated.', redirectTo: "/projects/{$this->project->id}");
    }

    private function statuses(): array
    {
        return [
            [
                'key' => 'inactive',
                'title' => 'Inactive',
            ],
            [
                'key' => 'active',
                'title' => 'Active',
            ],
        ];
    }

    public function with(): array
    {
        return [
            'statuses' => $this->statuses()
        ];
    }
}; ?>

<div>
    <x-header title="{{ $project->id ? 'Edit' : 'Create' }} Project" separator />

    <div class="grid lg:grid-cols-4 gap-10">
        <x-form wire:submit="save" class="col-span-3">

            <x-input label="Name" wire:model="name" />

            <x-textarea label="Description" wire:model="description" rows="5" @keydown.meta.enter="$wire.save()" />

            <x-select label="Status" wire:model="status" placeholder="Select a Status"
                      option-value="key" option-label="title" :options="$statuses" />

            <x-slot:actions>
                <x-button label="Cancel" link="/projects" />
                <x-button label="Update" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="save" />
            </x-slot:actions>
        </x-form>
    </div>
</div>