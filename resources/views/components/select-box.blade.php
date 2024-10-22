<div class="w-full pb-3">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-select id="{{ $model }}" wire:model.live="{{ $model }}" class="w-full">
        <option value="">Seçiniz</option>
        @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </x-select>
    <x-input-error for="{{ $model }}" class="mt-2" />
</div>
