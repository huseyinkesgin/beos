<?php

namespace App\Livewire\Portfolio;

use App\Models\Type;
use App\Models\State;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class TypeEdit extends Component
{

    public $typeId;
    public $category_id;
    public $name;
    public $isActive;
    public $form_path;
    public $note;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadType'];

    protected function rules()
    {
        return [
            'category_id' => 'required',
            'form_path' => 'required',
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
        $this->form_path = $type->form_path;

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

        $type = Type::findOrFail($this->typeId);
        $type->update([
            'category_id'=> $this->category_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'form_path' => $this->form_path,
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
