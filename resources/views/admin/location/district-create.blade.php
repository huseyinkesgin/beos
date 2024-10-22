{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Bölge Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="sm">
        <x-slot name="title">
            Yeni Bölge Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>

                 <!-- state_id -->
                 <x-select-boxo label="İl Seç" model="state_id" :options="$states" />

                <!-- city_id -->
                <x-select-boxo label="İlçe Seç" model="city_id" :options="$cities" />

                 <!-- name -->
                 <x-input-text label="Bölge Adı" model="name" />

                <!-- isActive -->
                <x-select-active />

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
