<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Personnel;

class PersonnelEdit extends Component
{
    public $personnelId;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $job_title;
    public $hire_date;
    public $termination_date;
    public $isActive;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadPersonnel'];

    protected function rules()
    {
        return [

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'nullable|email|unique:personnels,email,' . $this->personnelId,
            'phone' => 'required|string',
            'job_title' => 'required|string',
            'hire_date' => 'required|string',
            'termination_date' => 'nullable|string',
            'isActive' => 'boolean',

    ];
}

    public function openEditModal($id)
    {
        $this->loadPersonnel($id);
        $this->open = true;
    }

    public function loadPersonnel($id)
    {
        $personnel = Personnel::findOrFail($id);

        $this->personnelId = $personnel->id;
        $this->first_name = $personnel->first_name;
        $this->last_name = $personnel->last_name;
        $this->email = $personnel->email;
        $this->phone = $personnel->phone;
        $this->job_title = $personnel->job_title;
        $this->hire_date = $personnel->hire_date;
        $this->termination_date = $personnel->termination_date;
        $this->isActive = (bool) $personnel->isActive;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $personnel = Personnel::findOrFail($this->personnelId);
        $personnel->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'job_title' => $this->job_title,
            'hire_date' => $this->hire_date,
            'termination_date' => $this->termination_date,
            'isActive' => $this->isActive,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Personel başarıyla güncellendi!', type: 'success');
        $this->reset();
    }

    public function render()
    {

        return view('admin.people.personnel-edit');
    }
}
