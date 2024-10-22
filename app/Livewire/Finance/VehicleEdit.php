<?php

namespace App\Livewire\Finance;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\On;

class VehicleEdit extends Component
{
    public  $license_plate, $brand, $model, $year, $purchase_date, $sell_date, $chassis_number, $registration_number, $isActive = true,$registration_image_path,   $insurance_policy_image_path, $insurance_policy_expiry,$casco_policy_image_path, $casco_policy_expiry, $additional_documents;

    public $vehicleId;
    public $open = false;


    protected $rules = [
        'license_plate' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required',
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


    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadVehicle($id);
        $this->open = true;
    }

    public function loadVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $this->vehicleId = $vehicle->id;
        $this->license_plate = $vehicle->license_plate;
        $this->brand = $vehicle->brand;
        $this->model = $vehicle->model;
        $this->year = $vehicle->year;
        $this->isActive = $vehicle->isActive;
        $this->registration_image_path = $vehicle->registration_image_path;
        $this->chassis_number = $vehicle->chassis_number;
        $this->registration_number = $vehicle->registration_number;
        $this->insurance_policy_image_path = $vehicle->insurance_policy_image_path;
        $this->insurance_policy_expiry = $vehicle->insurance_policy_expiry;
        $this->casco_policy_image_path = $vehicle->casco_policy_image_path;
        $this->casco_policy_expiry = $vehicle->casco_policy_expiry;
        $this->additional_documents = $vehicle->additional_documents;

        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $vehicle = Vehicle::findOrFail($this->billId);
        $vehicle::update([
            'license_plate' => $this->license_plate,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'isActive' => $this->isActive,
            'registration_image_path' => $this->registration_image_path,
            'chassis_number' => $this->chassis_number,
            'registration_number' => $this->registration_number,
            'insurance_policy_image_path' => $this->insurance_policy_image_path,
            'insurance_policy_expiry' => $this->insurance_policy_expiry,
            'casco_policy_image_path' => $this->casco_policy_image_path,
            'casco_policy_expiry' => $this->casco_policy_expiry,
        ]);

        $this->dispatch('vehicle-edited');
        $this->dispatch('notify', title: 'Başarılı', text: 'Araç başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.finance.vehicle-edit');
    }
}
