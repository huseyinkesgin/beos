<?php

namespace App\Livewire\Portfolio;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $categoryId;
    public $name;
    public $isActive;
    public $note;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadCategory'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->categoryId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }
    public function openEditModal($id)
    {
        $this->loadCategory($id);
        $this->open = true;
    }

    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isActive = $category->isActive;
        $this->note = $category->note;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');

        $this->dispatch('notify', title: 'Başarılı', text: 'Kategori başarıyla güncellendi!', type: 'success');

        $this->reset(['categoryId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        return view('admin.portfolio.category-edit');
    }
}
