<div class="my-4">
    <x-label for="{{ $model }}">{{ $label }}</x-label>
    <x-select id="{{ $model }}" wire:model="{{ $model }}" class="w-full px-4 py-2 rounded">
        <option value="">Seçiniz</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" @if($option->id == $selected) selected @endif>
                {{ $option->name }}
            </option>
        @endforeach
    </x-select>
    <x-input-error for="{{ $model }}" class="mt-2" />
</div>
