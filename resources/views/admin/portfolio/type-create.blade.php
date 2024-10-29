{{-- resources/views/livewire/portfolio/state-create.blade.php --}}
<div>

    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">
        Yeni Emlak Tipi
    </x-dark-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni Emlak Tipi Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>

                <div class="my-4">
                    <x-label>Kategori Seç</x-label>
                    <x-select id="category_id" wire:model="category_id" class="w-full px-4 py-2 rounded">
                        <option value="">Seçiniz</option>
                        @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="my-4">
                    <x-label>Emlak Tipi</x-label>
                    <x-input type="text" class="w-full" placeholder="Tip adını yazınız" wire:model.live="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div class="my-4">
                    <x-label>Durum</x-label>
                    <x-select id="isActive" wire:model="isActive" class="w-full px-4 py-2 border rounded">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </x-select>
                </div>
                <div class="my-4">
                <x-select wire:model.live="form_path">
                    <option value="">Form Seçiniz</option>
                    @foreach($this->getFormOptions() as $form)
                        <option value="admin.portfolio.forms.{{ $form }}-form">{{ ucfirst($form) }}</option>
                    @endforeach
                </x-select>
                </div>

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <div>
                <x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
                    Vazgeç
                </x-secondary-button>
                <x-button wire:click="save">Kaydet</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
