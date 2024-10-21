<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\District;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Traits\PaginateReset;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\RestoreAndDeleteTrait;

class DistrictTable extends Component
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
    public $modelClass = District::class;

    #[On('district-created')]
    #[On('district-edited')]
    #[On('district-trashed')]
    #[On('district-deleted')]
    public function render()
    {
        $districts = District::filter($this->search, $this->activeFilter, $this->deletedFilter)
        ->sortable($this->sortField, $this->sortDirection)
        ->paginate($this->pagination);

        return view('admin.location.district-table', [
            'districts' => $districts
        ]);
    }
}
