<?php

namespace App\Livewire\People;

use App\Models\Personnel;
use App\Traits\HasSortable;
use Livewire\Component;
use Livewire\WithPagination;

class PersonnelTable extends Component
{
    use HasSortable;
    use WithPagination;

    public $search = '';

    public $activeFilter = 'all';

    public $deletedFilter = 'without';

    public $pagination = 10;

    public $personnel_type_filter = '';

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

    public function toggleActive($personnelId)
    {
        $personnel = Personnel::find($personnelId);
        if ($personnel) {
            $personnel->isActive = ! $personnel->isActive;
            $personnel->save();
            $this->dispatch('notify', title: 'Başarılı', text: 'Personelin durumu başarlı bir şekilde güncellendi!', type: 'success');
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

    public function showDetails($id)
    {
        return redirect()->route('personnel.show', $id);
    }

    public function restore($id)
    {
        $personnel = Personnel::withTrashed()->findOrFail($id);
        $personnel->restore();
        $this->dispatch('notify', title: 'Başarılı', text: 'Personel başarıyla çöp kutusundan kurtarıldı!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function forceDelete($id)
    {
        $personnel = Personnel::withTrashed()->findOrFail($id);
        $personnel->forceDelete();

        $this->dispatch('notify', title: 'Başarılı', text: 'Personel başarıyla tamamen silindi!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        $personnels = Personnel::filter(
            $this->search,
            $this->activeFilter,
            $this->deletedFilter,

        )
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);

        return view('admin.people.personnel-table', [
            'personnels' => $personnels,
        ]);
    }
}
