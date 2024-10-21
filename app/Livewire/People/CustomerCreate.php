<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;

class CustomerCreate extends Component
{


    public $customer_type = "Bireysel", $category, $name, $company_name, $tax_office, $tax_no, $phone, $email,$address, $isActive = true, $note;

    public $open = false;

    protected $rules = [
        'customer_type' => 'required|string',
        'category' => 'required|string',
        'company_name' => 'nullable|string|max:255',
        'tax_office' => 'nullable|string|max:255',
        'tax_no' => 'nullable|string|max:50',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:customers,email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'isActive' => 'boolean',
        'note' => 'nullable|string'
    ];
    #[On('openCreateModal')]
    public function openModal()
    {
       $this->open = true; // Modal'ı aç
    }


    public function save()
    {
        $this->validate();

        Customer::create([
            'customer_type' => $this->customer_type,
            'category' => $this->category,
            'name' => $this->name,
            'company_name' => $this->company_name,
            'tax_office' => $this->tax_office,
            'tax_no' => $this->tax_no,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'isActive' => $this->isActive,
            'note' => $this->note
        ]);

        $this->dispatch('customer-created');
        $this->dispatch('notify', title: 'Tebrikler!', text: 'Müşteri başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.people.customer-create');
    }
}
