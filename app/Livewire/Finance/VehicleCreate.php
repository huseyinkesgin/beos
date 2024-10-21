<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\On;

class VehicleCreate extends Component
{

      public  $license_plate, $brand, $model, $year, $purchase_date, $sell_date, $chassis_number, $registration_number, $isActive = true,$registration_image_path,   $insurance_policy_image_path, $insurance_policy_expiry,$casco_policy_image_path, $casco_policy_expiry, $additional_documents;

    public $open = false;

    protected $rules = [
        'license_plate' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|string',
        'purchase_date' => 'nullable|date',
        'sell_date' => 'nullable|date',
        'chassis_number' => 'nullable',
        'registration_number' => 'nullable',
        'isActive' => 'boolean',
        'registration_image_path' => 'nullable',
        'insurance_policy_image_path' => 'nullable',
        'insurance_policy_expiry' => 'nullable',
        'casco_policy_image_path' => 'nullable',
        'casco_policy_expiry' => 'nullable',
        'additional_documents' => 'nullable',
    ];


    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Bill::create([
            'license_plate' => $this->license_plate,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'purchase_date' => $this->purchase_date,
            'is_recurring' => $this->is_recurring,
            'chassis_number' => $this->chassis_number,
            'registration_number' => $this->registration_number,
            'isActive' => $this->isActive,
            'registration_image_path' => $this->registration_image_path,
            'insurance_policy_image_path' => $this->insurance_policy_image_path,
            'insurance_policy_expiry' => $this->insurance_policy_expiry,
            'casco_policy_image_path' => $this->casco_policy_image_path,
            'casco_policy_expiry' => $this->casco_policy_expiry,
            'additional_documents' => $this->additional_documents,
        ]);

        $this->dispatch('bill-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }
    public function render()
    {
        return view('admin.finance.vehicle-create');
    }
}