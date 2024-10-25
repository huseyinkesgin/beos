{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-button-orange wire:click="$dispatch('openCreateStateModal')"> <i class="mr-2 font-bold text-white cursor-pointer fa-solid fa-plus"></i>İl</x-button-oran>

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
