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

            // Yıl kısmı (İlk 4 karakter)
            if(value.length >= 1) {
                formatted = value.slice(0, 4) + '-';
            }

            // Ay kısmı (5. ve 6. karakter)
            if(value.length >= 5) {
                let month = value.slice(4, 6);
                if (parseInt(month) > 12) {
                    month = '12'; // Ayı 12 ile sınırlandır
                } else if (parseInt(month) < 1) {
                    month = '01'; 
                }
                formatted += month + '-';
            }

            // Gün kısmı (7. ve 8. karakter)
            if(value.length >= 7) {
                let day = value.slice(6, 8);
                if (parseInt(day) > 31) {
                    day = '31'; // Günü 31 ile sınırlandır
                } else if (parseInt(day) < 1) {
                    day = '01'; 
                }
                formatted += day;
            }

            $event.target.value = formatted;
        "
        class="w-full" 
        placeholder="YYYY-MM-DD" 
    />
    <x-input-error for="{{ $model }}" />
</div>
