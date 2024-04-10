<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use App\Models\Environment;
use Illuminate\Support\Collection;

new class extends Component {

    use Toast;

    public Project $project;

    public function environments() : collection
    {
        return Environment::all();
    }

    public function with(): array
    {
        return [
            'environments' => $this->environments(),
        ];
    }
}; ?>

<div>
    <x-header title="Project - {{ $project->name }}" />

    <x-header size="text-inherit" separator progress-indicator>
        {{-- SEARCH --}}
        <x-slot:title>
            <x-button label="Create" icon="o-plus-circle" class="ml-3 btn-primary" link="/projects/{{ $project->slug }}/environments/create" />
        </x-slot:title>

    </x-header>

    <div class="mt-10 grid grid-cols-4 gap-4 sm:!p-2" >
        {{-- PROJECTS LIST --}}
        @forelse($environments as $environment)
            {{-- Notice `progress-indicator` target --}}
            <x-card class="m-1 flex-1 bg-gray-200 p-4" :title="$environments->name" :subtitle="$environments->description" separator progress-indicator>
                <x-button label="" link="/projects/{{ $project->slug }}/environments/{{ $environments->slug }}" icon="o-paper-airplane" />
            </x-card>
        @empty
            {{-- NO RESULTS--}}
            <x-alert title="Nothing here!" description="Try to remove some filters." icon="o-exclamation-triangle" class="bg-base-100 border-none">
                <x-slot:actions>
                    <x-button label="Clear filters" class="btn btn-primary" wire:click="clear" icon="o-x-mark" spinner />
                </x-slot:actions>
            </x-alert>
        @endforelse

    </div>

</div>