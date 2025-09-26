{{-- resources/views/livewire/location/state-edit.blade.php --}}
<x-dialog-modal wire:model="open" maxWidth="sm">
    <x-slot name="title">
        <span class="text-black uppercase">  {{ $name }} DÜZENLEME FORMU</span>
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
