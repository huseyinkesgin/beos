<!-- resources/views/livewire/finance/personnel-balance-create.blade.php -->

<div>
    <!-- Yeni Nakit İşlemi Ekle Butonu -->
    <x-dark-button wire:click="openModal">Nakit Girişi</x-dark-button>

    <!-- Nakit Girişi Modal -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">Nakit Girişi </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- personnel_id -->
                    <x-select-boxo label="Personel" model="personnel_id" :options="$personnels" />
                    <!-- cash_in -->
                    <x-input-text label="Nakit Girişi" model="cash_in" />
                </div>
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>