{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-button-orange wire:click="$dispatch('openCreateDistrictModal')"> <i class="mr-2 font-bold text-white cursor-pointer fa-solid fa-plus"></i>Bölge </x-button-orange>
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
