<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input type="date" id="{{ $model }}" wire:model.live="{{ $model }}" class="w-full flatpickr-input" />
    <x-input-error for="{{ $model }}" />
</div>

