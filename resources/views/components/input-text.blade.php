<div class="w-full">
    <x-label for="{{ $id }}" value="{{ $label }}" />
    <x-input type="{{ $type }}" id="{{ $id }}" wire:model.live="{{ $model }}" class="w-full" />
    <x-input-error for="{{ $id }}" />
</div>
