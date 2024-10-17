<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Personnel;

class PersonnelDelete extends Component
{
    public $personnelId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->personnelId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $personnel = Personnel::findOrFail($this->personnelId);
        $personnel->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Personel başarılı bir şekilde çöp kutusuna gönderildi!', type: 'success');

        $this->reset(['personnelId', 'open']);
    }

    public function render()
    {
        return view('admin.people.personnel-delete');
    }
}
