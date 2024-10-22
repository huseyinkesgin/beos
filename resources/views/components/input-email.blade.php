<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input type="email" id="{{ $model }}" wire:model.live="{{ $model }}" class="w-full" />
    <x-input-error for="{{ $model }}" />
</div>
