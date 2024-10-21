<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use App\Models\Vehicle;
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

class VehicleTable extends Component
{

    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait,RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, ActiveFilterReset, PaginateReset;

    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = Vehicle::class;


    #[On('vehicle-created')]
    #[On('vehicle-edited')]
    #[On('vehicle-trashed')]
    #[On('vehicle-deleted')]
    public function render()
    {
        $vehicles = Vehicle::filter($this->search, $this->activeFilter, $this->deletedFilter)
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);
        return view('admin.finance.vehicle-table',[
            'vehicles' => $vehicles
        ]);
    }
}
