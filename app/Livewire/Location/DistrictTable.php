<?php

namespace App\Livewire\Location;

use App\Models\District;
use App\Traits\HasSortable;
use Livewire\Component;
use Livewire\WithPagination;
use Laravel\Jetstream\InteractsWithBanner;

class DistrictTable extends Component
{

    use WithPagination;
    use InteractsWithBanner;
    use HasSortable;

    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 10;

    protected $listeners = ['refreshTable' => '$refresh'];

    public $sortField = 'created_at'; // Varsayılan sıralama alanı
    public $sortDirection = 'asc'; // Varsayılan sıralama yönü

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
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
        if ($this->sortField === $field) {
            return $this->sortDirection === 'asc' ? '▲' : '▼';
        }
        return '';
    }

    function toggleActive($districtId)
    {
        $district = District::find($districtId);
        if ($district) {
            $district->isActive = !$district->isActive;
            $district->save();
            $this->dispatch('notify', title: 'Başarılı', text: 'Bölge durumu başarlı bir şekilde güncellendi!', type: 'success');
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

    public function restore($id)
    {
        $district = District::withTrashed()->findOrFail($id);
        $district->restore();
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla çöp kutusundan kurtarıldı!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function forceDelete($id)
    {
        $district = District::withTrashed()->findOrFail($id);
        $district->forceDelete(); // Kalıcı olarak silme

        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla tamamen silindi!', type: 'success');
        $this->dispatch('refreshTable');
    }

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
