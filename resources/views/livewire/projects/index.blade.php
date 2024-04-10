<?php

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Volt\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $sort = 'all';

    public function sorts(): array
    {
        return [
            [
                'id' => 'all',
                'name' => 'All Projects'
            ],
            [
                'id' => 'active',
                'name' => 'Active Projects'
            ],
            [
                'id' => 'inactive',
                'name' => 'Inactive Projects'
            ]
        ];
    }

    public function clear(): void
    {
        $this->reset();
    }

    public function projects() : LengthAwarePaginator
    {
        return Project::query()
            ->where('name', 'like', "%$this->search%")
            ->when($this->sort !== 'all', fn (Builder $query) => $query->where('status', $this->sort))
            ->paginate();
    }

    public function with(): array
    {
        return [
            'projects' => $this->projects(),
            'sorts' => $this->sorts()
        ];
    }
}; ?>

<div>
    <x-header title="Projects" />

    <x-header size="text-inherit" separator progress-indicator>
        {{-- SEARCH --}}
        <x-slot:title>
            <x-input placeholder="Search ..." wire:model.live.debounce="search" icon="o-magnifying-glass">
                <x-slot:append>
                    <x-button label="Create" icon="o-plus-circle" class="ml-3 btn-primary" link="/projects/create" />
                </x-slot:append>
            </x-input>
        </x-slot:title>

        {{-- SORT --}}
        <x-slot:actions>
            <x-radio wire:model.live="sort" :options="$sorts" class="text-sm" />
        </x-slot:actions>
    </x-header>

    <div class="mt-10 grid grid-cols-4 gap-4 sm:!p-2" >
        {{-- PROJECTS LIST --}}
        @forelse($projects as $project)
            {{-- Notice `progress-indicator` target --}}
            <x-card class="m-1 flex-1 bg-gray-200 p-4" :title="$project->name" :subtitle="$project->description" separator progress-indicator>
                <x-button label="" link="/projects/{{ $project->slug }}" icon="o-paper-airplane" />
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
    <div>
        <x-menu-separator />
        {{ $projects->links() }}
    </div>

</div>