<x-dialog-modal wire:model="open" maxWidth="sm">
    <x-slot name="title">
        {{ $name }}
    </x-slot>

    <x-slot name="content">
        <x-form>

            <!-- phone -->
            <x-input-text label="Kategori Adı" model="name" />
            <!-- isActive -->
            <x-select-active />

        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-modal-footer />
    </x-slot>
</x-dialog-modal>
