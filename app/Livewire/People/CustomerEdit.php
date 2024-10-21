<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;

class CustomerEdit extends Component
{
    public $customer_type = "Bireysel", $category, $name, $company_name, $tax_office, $tax_no, $phone, $email,$address, $isActive = true, $note;
    public $customerId;

    public $open = false;

    protected function rules()
    {
        return [
        'customer_type' => 'required|string',
        'category' => 'required|string',
        'company_name' => 'nullable|string|max:255',
        'tax_office' => 'nullable|string|max:255',
        'tax_no' => 'nullable|string|max:50',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:customers,email,customerId',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'isActive' => 'boolean',
        'note' => 'nullable|string'
    ];
}
    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadCustomer($id);
        $this->open = true;
    }

    public function loadCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customerId = $customer->id;
        $this->customer_type = $customer->customer_type;
        $this->category = $customer->category;
        $this->name = $customer->name;
        $this->company_name = $customer->company_name;
        $this->tax_office = $customer->tax_office;
        $this->tax_no = $customer->tax_no;
        $this->phone = $customer->phone;
        $this->email = $customer->email;
        $this->address = $customer->address;
        $this->isActive = (bool) $customer->isActive;
        $this->note = $customer->note;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $customer = Customer::findOrFail($this->customerId);
        $customer->update([
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

        $this->dispatch('customer-edited');
        $this->dispatch('notify', title: 'Tebrikler', text: 'Müşteri başarıyla güncellendi!', type: 'success');
        $this->reset();
    }

    public function render()
    {
        return view('admin.people.customer-edit');
    }
}
