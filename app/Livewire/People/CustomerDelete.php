<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;

class CustomerDelete extends Component
{
    public $customerId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->customerId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $customer = Customer::findOrFail($this->customerId);
        $customer->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Müşteri başarılı bir şekilde çöp kutusuna gönderildi!', type: 'success');

        $this->reset(['customerId', 'open']);
    }

    public function render()
    {
        return view('admin.people.customer-delete');
    }
}
