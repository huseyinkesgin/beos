<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\PersonnelBalance;

class PersonnelBalanceCreate extends Component
{
    public  $personnel_id, $cash_in, $cash_out;

    public $open = false; 

    protected $rules = [
        'personnel_id' => 'required|exists:personnels,id',
        'cash_in' => 'nullable|numeric|min:0',
        'cash_out' => 'nullable|numeric|min:0',
    ];

   #[On('openBalanceModal')]
    public function openModal()
    {
        $this->open = true; // Modal açılacak
    }

    public function save()
    {
        $this->validate();

        PersonnelBalance::create([
            'personnel_id' => $this->personnel_id,
            'cash_in' => $this->cash_in,
            'cash_out' => $this->cash_out,
        ]);

        // Bakiye güncellemesi
        PersonnelBalance::updateBalance($this->personnel_id);

        $this->dispatch('balance-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'Nakit girişi başarıyla kayıt edildi!', type: 'success');
        // Formu temizleme ve modalı kapatma
        $this->reset(['personnel_id', 'cash_in', 'cash_out', 'open']);

    }

    public function render()
    { $personnels = Personnel::active()->get();
        return view('admin.finance.personnel-balance-create',[
            'personnels' => $personnels
    ]);
    }
}
