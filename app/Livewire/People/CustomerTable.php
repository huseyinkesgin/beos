<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;
use App\Traits\HasSortable;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use HasSortable;
    use WithPagination;

    public $search = '';

    public $activeFilter = 'all';

    public $deletedFilter = 'without';

    public $pagination = 10;

    public $customer_type_filter = '';

    public $category_filter = '';

    public $sortField = 'created_at'; // Varsayılan sıralama alanı

    public $sortDirection = 'asc'; // Varsayılan sıralama yönü

    protected $listeners = ['refreshTable' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }

    // Sıralama okunu döndürmek için metod
    public function getSortIcon($field)
    {
        if ($this->sortField == $field) {
            return $this->sortDirection == 'asc' ? '▲' : '▼';
        }

        return '';
    }

    public function toggleActive($customerId)
    {
        $customer = Customer::find($customerId);
        if ($customer) {
            $customer->isActive = ! $customer->isActive;
            $customer->save();
            $this->dispatch('notify', title: 'Başarılı', text: 'Müşteri durumu başarlı bir şekilde güncellendi!', type: 'success');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingActiveFilter()
    {
        $this->resetPage();
    }

    public function updatingDeletedFilter()
    {
        $this->resetPage();
    }

    public function updatingPagination()
    {
        $this->resetPage();
    }

    public function updatingCustomerTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function restore($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->restore();
        $this->dispatch('notify', title: 'Başarılı', text: 'Müşteri başarıyla çöp kutusundan kurtarıldı!', type: 'success');
        $this->dispatch('customer-trashed');
    }

    public function forceDelete($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);
        $customer->forceDelete();

        $this->dispatch('customer-deleted');
        $this->dispatch('notify', title: 'Başarılı', text: 'Müşteri başarıyla tamamen silindi!', type: 'success');
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
