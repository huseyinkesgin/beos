<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input type="text" id="{{ $model }}" wire:model.live="{{ $model }}" class="w-full" placeholder="0532 400 00 00"  />
    <x-input-error for="{{ $model }}" />
</div>

