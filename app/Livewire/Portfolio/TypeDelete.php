<?php

namespace App\Livewire\Portfolio;

use App\Models\Type;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class TypeDelete extends Component
{

    use InteractsWithBanner;

    public $typeId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->typeId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $type = Type::findOrFail($this->typeId);
        $type->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Tip başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['typeId', 'open']);
    }

    public function render()
    {
        return view('admin.portfolio.type-delete');
    }
}
