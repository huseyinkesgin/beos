<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Traits\PaginateReset;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\RestoreAndDeleteTrait;
use Laravel\Jetstream\InteractsWithBanner;

class StateTable extends Component
{

    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait,RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, ActiveFilterReset, PaginateReset;

    /* ------------------------- Tablo Dışı Özellikler ------------------------- */
    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = State::class;



    #[On('state-created')]
    #[On('state-edited')]
    #[On('state-trashed')]
    #[On('state-deleted')]
    public function render()
    {
        $states = State::filter($this->search, $this->activeFilter, $this->deletedFilter)
        ->sortable($this->sortField, $this->sortDirection)
        ->paginate($this->pagination);

        return view('admin.location.state-table', [
            'states' => $states
        ]);
    }
}
