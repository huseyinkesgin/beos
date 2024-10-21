<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\PersonnelBalance;

class PersonnelBalanceEdit extends Component
{
    public  $personnel_id, $cash_in, $cash_out;
    public $balanceId;


    public $open = false;


    protected function rules()
    {
        return [
        'personnel_id' => 'required|exists:personnels,id',
        'cash_in' => 'nullable|numeric|min:0',
        'cash_out' => 'nullable|numeric|min:0',
        ];
    }
    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadBalance($id);
        $this->open = true;
    }

    public function loadBalance($id)
    {
        $balance = PersonnelBalance::findOrFail($id);
        $this->balanceId = $balance->id;
        $this->personnel_id = $balance->personnel_id;
        $this->cash_in = $balance->cash_in;
        $this->cash_out = $balance->cash_out;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $balance = PersonnelBalance::findOrFail($this->balanceId);
        $balance->update([
            'personnel_id' => $this->personnel_id,
            'cash_in' => $this->cash_in,
            'cash_out' => $this->cash_out,
        ]);


        $this->dispatch('balance-edited');
        $this->dispatch('notify', title: 'Başarılı', text: 'Nakit Girişi başarıyla güncellendi!', type: 'success');
        $this->reset(['balanceId', 'cash_in', 'cash_out', 'open']);
    }

    public function render()
    {
        $personnels = Personnel::active()->get();
        return view('admin.finance.personnel-balance-edit',[
            'personnels' => $personnels
    ]);
}
}
