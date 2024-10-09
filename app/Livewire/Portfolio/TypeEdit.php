<?php

namespace App\Livewire\Portfolio;

use App\Models\Type;
use App\Models\State;
use Livewire\Component;
use App\Models\Category;
use Laravel\Jetstream\InteractsWithBanner;

class TypeEdit extends Component
{
    use InteractsWithBanner;

    public $typeId;
    public $category_id;
    public $name;
    public $isActive;
    public $note;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadType'];

    protected function rules()
    {
        return [
            'category_id' => 'required',
            'name' => 'required|string|max:255|unique:types,name,' . $this->typeId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }
    public function openEditModal($id)
    {
        $this->loadType($id);
        $this->open = true;
    }

    public function loadType($id)
    {
        $type = Type::findOrFail($id);
        $this->typeId = $type->id;
        $this->category_id = $type->category_id;
        $this->name = $type->name;
        $this->isActive = $type->isActive;
        $this->note = $type->note;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $type = Type::findOrFail($this->typeId);
        $type->update([
            'category_id'=> $this->category_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');

        $this->dispatch('notify', title: 'Başarılı', text: 'Tip başarıyla güncellendi!', type: 'success');

        $this->reset(['typeId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        $categories = Category::active()->get();
        return view('admin.portfolio.type-edit',[
            'categories' => $categories
        ]);
    }
}
