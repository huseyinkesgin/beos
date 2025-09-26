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

            // Gün kısmı (İlk 2 karakter)
            if(value.length >= 1) {
                let day = value.slice(0, 2);
                if (value.length >= 2 && parseInt(day) > 31) day = '31';
                else if (value.length >= 2 && parseInt(day) < 1) day = '01';
                formatted = day;
                if(value.length > 2) formatted += '.';
            }

            // Ay kısmı (3. ve 4. karakter)
            if(value.length >= 3) {
                let month = value.slice(2, 4);
                if (value.length >= 4 && parseInt(month) > 12) month = '12';
                else if (value.length >= 4 && parseInt(month) < 1) month = '01';
                formatted += month;
                if(value.length > 4) formatted += '.';
            }

            // Yıl kısmı (5. ve 8. karakter)
            if(value.length >= 5) {
                let year = value.slice(4, 8);
                formatted += year;
            }

            $event.target.value = formatted;
            
            // Backend için Y-m-d formatına çevir
            let backendFormat = '';
            if (formatted.length === 10) {
                let parts = formatted.split('.');
                if (parts.length === 3) {
                    backendFormat = parts[2] + '-' + parts[1] + '-' + parts[0]; // YYYY-MM-DD
                }
            }
            
            // Livewire model'i güncellemek için dispatch
            $wire.set('{{ $model }}', backendFormat || formatted);
        "
        class="w-full" 
        placeholder="GG.AA.YYYY" 
    />
    <x-input-error for="{{ $model }}" />
</div>
