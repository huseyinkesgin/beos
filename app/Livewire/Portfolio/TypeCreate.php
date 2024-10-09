<?php

namespace App\Livewire\Portfolio;

use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Str;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class TypeCreate extends Component
{
   
    public $category_id;
    public $name;
    public $isActive = true;
    public $note;
    public $open = false;

    protected $rules = [
        'category_id' => 'required',
        'name' => 'required|string|max:255|unique:types,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Type::create([
            'id' => (string) Str::uuid(),
            'category_id' => $this->category_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Tip başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        $categories = Category::active()->get();
        return view('admin.portfolio.type-create',[
            'categories' => $categories
        ]);
    }
}
