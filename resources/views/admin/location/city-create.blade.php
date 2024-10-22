{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button  wire:click="$dispatch('openCreateModal')" >
        Yeni İlçe Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="sm">
        <x-slot name="title">
            Yeni İlçe Oluştur
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
