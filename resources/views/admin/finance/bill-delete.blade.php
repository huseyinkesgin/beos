<div>
    <!-- resources/views/livewire/location/state-delete.blade.php -->
<x-confirmation-modal wire:model="open">
    <x-slot name="title">
        Gider Faturası Silme
    </x-slot>

    <x-slot name="content">
        <span class="flex justify-center text-lg font-semibold">Bu faturayı silmek istediğinizden emin misiniz?</span>
        <br>Bu işlem çöp kutusuna gönderir. Tamamen silmek için Silinmişlerden "KALICI SİL" yaparak silmelisiniz.
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
            İptal
        </x-secondary-button>

        <x-danger-button wire:click="delete" wire:loading.attr="disabled" class="ml-2">
            Sil
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>

</div>
