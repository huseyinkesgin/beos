<?php

namespace App\Livewire\Portfolio;

use App\Models\Category;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class CategoryDelete extends Component
{
    public $categoryId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $category = Category::findOrFail($this->categoryId);
        $category->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Kategori başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['categoryId', 'open']);
    }

    public function render()
    {
        return view('admin.portfolio.category-delete');
    }
}
