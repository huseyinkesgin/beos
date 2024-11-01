<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input type="text" id="{{ $model }}" wire:model.live="{{ $model }}" {{ $attributes->merge(['class' => 'w-full']) }} />
    <x-input-error for="{{ $model }}" />
</div>
