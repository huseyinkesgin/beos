<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use Livewire\Component;
use Livewire\Attributes\On;

class BillDelete extends Component
{
    public $billId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->billId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $bill = Bill::findOrFail($this->billId);
        $bill->delete();

        $this->dispatch('bill-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['billId', 'open']);
    }

    public function render()
    {
        return view('admin.finance.bill-delete');
    }
}
