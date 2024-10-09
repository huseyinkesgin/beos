 {{-- resources/views/livewire/location/state-edit.blade.php --}}
<x-dialog-modal wire:model="open">
    <x-slot name="title">
        İl Düzenle
    </x-slot>

    <x-slot name="content">
        <x-form>

            <div class="my-4">
                <x-label>İl Adı</x-label>
                <x-input type="text" class="w-full" placeholder="İl adını yazınız" wire:model.live="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="my-4">
                <x-label>Durum</x-label>
                <x-select id="isActive" wire:model="isActive" class="w-full px-4 py-2 rounded">
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </x-select>
            </div>

        </x-form>
       
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
            Vazgeç
        </x-secondary-button>
        <x-button wire:click="save" wire:loading.attr="disabled" class="ml-2">
            Güncelle
        </x-button>
    </x-slot>
</x-dialog-modal>


