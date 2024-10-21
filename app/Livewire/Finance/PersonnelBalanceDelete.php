<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PersonnelBalance;

class PersonnelBalanceDelete extends Component
{
    public $balanceId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->balanceId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $balance = PersonnelBalance::findOrFail($this->balanceId);
        $balance->delete();

        $this->dispatch('balance-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'Nakit akışı başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['balanceId', 'open']);
    }

    public function render()
    {
        return view('admin.finance.personnel-balance-delete');
    }
}
