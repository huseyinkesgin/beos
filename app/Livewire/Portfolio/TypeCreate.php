<?php

namespace App\Livewire\Portfolio;

use App\Models\Type;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TypeCreate extends Component
{
    public $category_id;
    public $name;
    public $isActive = true;
    public $note;
    public $form_path;
    public $open = false;

    protected $rules = [
        'category_id' => 'required',
        'form_path' => 'required',
        'name' => 'required|string|max:255|unique:types,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function getFormOptions()
    {
        $files = File::files(resource_path('views/admin/portfolio/forms'));
        $formOptions = [];

        foreach ($files as $file) {
            $name = $file->getFilename();
            if (preg_match('/^(.+)-form\.blade\.php$/', $name, $matches)) {
                $formOptions[] = $matches[1]; // '-' öncesini alır
            }
        }

        return $formOptions;
    }

    public function save()
    {
        $this->validate();

        Type::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'form_path' => $this->form_path,
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
        return view('admin.portfolio.type-create', [
            'categories' => $categories
        ]);
    }
}
