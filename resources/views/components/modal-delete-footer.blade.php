<x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
    İptal
</x-secondary-button>

<x-danger-button wire:click="delete" wire:loading.attr="disabled" class="ml-2">
    Sil
</x-danger-button>
