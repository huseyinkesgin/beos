<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\Personnel;

class PersonnelShow extends Component
{
    public $personnel;

    public function mount($id)
    {
        $this->personnel = Personnel::with('addresses')->findOrFail($id);
    }

    // public function showDetails($id)
    // {
    //     return redirect()->route('personnel.show', $id);
    // }

    public function render()
    {
        return view('admin.people.personnel-show', [
            'personnel' => $this->personnel,
        ]);
    }
}
