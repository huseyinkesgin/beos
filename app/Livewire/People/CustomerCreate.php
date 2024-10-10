<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;

class CustomerCreate extends Component
{


    public $customer_type = "Bireysel";
    public $category;
    public $name;
    public $company_name;
    public $tax_office;
    public $tax_no;
    public $phone;
    public $email;
    public $address;
    public $isActive = true; // varsayılan olarak aktif
    public $note;

    public $open = false;
    protected $listeners = ['openCreateModal' => 'openModal'];
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

    public function openModal()
    {
        $this->resetForm(); // Formu temizle
        $this->open = true; // Modal'ı aç
    }



    public function resetForm()
    {
        $this->customer_type = "Bireysel";
        $this->category = null;
        $this->name = null;
        $this->company_name = null;
        $this->tax_office = null;
        $this->tax_no = null;
        $this->phone = null;
        $this->email = null;
        $this->address = null;
        $this->isActive = true;
        $this->note = null;
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
            'is_active' => $this->isActive,
            'note' => $this->note
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.people.customer-create');
    }
}
