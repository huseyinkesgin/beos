<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input 
        type="text" 
        id="{{ $model }}" 
        wire:model.live="{{ $model }}" 
        x-data 
        x-on:input="
            let value = $event.target.value.replace(/\D/g, '').slice(0, 11); 
            let formatted = '';
            if(value.length > 0) formatted = '(' + value.slice(0, 4) + ') ';
            if(value.length >= 5) formatted += value.slice(4, 7) + ' ';
            if(value.length >= 8) formatted += value.slice(7, 9) + ' ';
            if(value.length >= 10) formatted += value.slice(9, 11);
            $event.target.value = formatted;
        "
        class="w-full" 
        placeholder="0500 000 00 00" 
    />
    <x-input-error for="{{ $model }}" />
</div>
