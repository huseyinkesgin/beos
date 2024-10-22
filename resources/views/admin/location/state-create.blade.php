{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button  wire:click="$dispatch('openCreateModal')">
        Yeni İl Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="sm">
        <x-slot name="title">
            Yeni State Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>

                <x-input-text label="İl Adı" model="name" />
                <!-- isActive -->
                <x-select-active />

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
