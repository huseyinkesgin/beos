<div class="w-full pb-2">
    <x-label for="{{ $model }}" value="{{ $label }}" />
    <x-input 
        type="text" 
        id="{{ $model }}" 
        wire:model.lazy="{{ $model }}"  
        x-data 
        x-on:input="
            let value = $event.target.value.replace(/\D/g, '').slice(0, 8);
            let formatted = '';
            if(value.length > 0) formatted = value.slice(0, 4) + '-';
            if(value.length >= 5) formatted += value.slice(4, 6) + '-';
            if(value.length >= 7) formatted += value.slice(6, 8);
            $event.target.value = formatted;
        "
        class="w-full" 
        placeholder="YYYY-MM-DD" 
    />
    <x-input-error for="{{ $model }}" />
</div>
