<?php

namespace App\Livewire\Location;

use App\Models\City;
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

class CityTable extends Component
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
    public $modelClass = City::class;


    #[On('city-created')]
    #[On('city-edited')]
    #[On('city-trashed')]
    #[On('city-deleted')]
    public function render()
    {
        $cities = City::filter($this->search, $this->activeFilter, $this->deletedFilter)
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate(perPage: $this->pagination);

        return view('admin.location.city-table', [
            'cities' => $cities
        ]);
    }
}
