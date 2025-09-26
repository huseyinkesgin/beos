<div>
    <x-dialog-modal wire:model="open" maxWidth="sm">
        <x-slot name="title">
            {{ $cityId ? 'İlçe Düzenle' : 'Yeni İlçe Ekle' }}
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