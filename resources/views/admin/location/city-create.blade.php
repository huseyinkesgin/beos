{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-button-orange wire:click="$dispatch('openCreateModal')"> <i
            class="mr-2 font-bold text-white cursor-pointer fa-solid fa-plus"></i>YENİ İLÇE EKLE</x-button-orange>
    <x-dialog-modal wire:model="open" maxWidth="sm">
        <x-slot name="title">
            İLÇE FORMU
        </x-slot>

        <x-slot name="content">
            <x-form>

                <!-- state_id -->
                <x-select-boxo label="İl Seç" model="state_id" :options="$states" />
                <!-- name -->
                <x-input-text label="İlçe Adı" model="name" />
                <!-- isActive -->
                <x-select-active />

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
