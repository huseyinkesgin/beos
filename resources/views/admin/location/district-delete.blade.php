<div>
    <!-- resources/views/livewire/location/state-delete.blade.php -->
<x-confirmation-modal wire:model="open">
    <x-slot name="title">
        İlçe Silme
    </x-slot>

    <x-slot name="content">
        <span class="flex justify-center text-lg font-semibold">Bu bölgeyi silmek istediğinizden emin misiniz?</span>
        <br>Bu işlem çöp kutusuna gönderir. Tamamen silmek için Silinmişlerden "KALICI SİL" yaparak silmelisiniz.
    </x-slot>

    <x-slot name="footer">
       <x-modal-delete-footer />
    </x-slot>
</x-confirmation-modal>

</div>
