<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Traits\PaginateReset;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\RestoreAndDeleteTrait;

class CustomerTable extends Component
{
    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait,RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, ActiveFilterReset, PaginateReset;

    public $customer_type_filter = '';
    public $category_filter = '';

    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 13;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = Customer::class;






    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }




    public function updatingCustomerTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }



    #[On('customer-created')]
    #[On('customer-edited')]
    #[On('customer-trashed')]
    #[On('customer-deleted')]
    public function render()
    {
        $customers = Customer::filter(
            $this->search,
            $this->activeFilter,
            $this->deletedFilter,
            $this->customer_type_filter,
            $this->category_filter
        )
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);

        return view('admin.people.customer-table', [
            'customers' => $customers,
        ]);
    }
}
