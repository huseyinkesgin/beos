{{-- resources/views/admin/portfolio/forms/Fabrika-form.blade.php --}}
<div>
    <!-- Arsa m² -->
    <div class="my-4">
        <x-label for="land_area_m2">Arsa Alanı (m²)</x-label>
        <x-input type="number" class="w-full" wire:model="land_area_m2" id="land_area_m2" placeholder="Arsa alanını m² cinsinden giriniz" />
        <x-input-error for="land_area_m2" class="mt-2" />
    </div>

    <!-- Open Area -->
    <div class="my-4">
        <x-label for="open_area">Açık Alan (m²)</x-label>
        <x-input type="number" class="w-full" wire:model="open_area" id="open_area" placeholder="Açık alanı m² cinsinden giriniz" />
        <x-input-error for="open_area" class="mt-2" />
    </div>

    <!-- Closed Area -->
    <div class="my-4">
        <x-label for="closed_area">Kapalı Alan (m²)</x-label>
        <x-input type="number" class="w-full" wire:model="closed_area" id="closed_area" placeholder="Kapalı alanı m² cinsinden giriniz" />
        <x-input-error for="closed_area" class="mt-2" />
    </div>

    <!-- Number of Floors -->
    <div class="my-4">
        <x-label for="floor_count">Kat Sayısı</x-label>
        <x-select wire:model="floor_count" id="floor_count" class="w-full">
            <option value="">Seçiniz</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </x-select>
        <x-input-error for="floor_count" class="mt-2" />
    </div>

    <!-- Electricity Power (KWA) -->
    <div class="my-4">
        <x-label for="electricity_power">Elektrik (KWA)</x-label>
        <x-input type="text" class="w-full" wire:model="electricity_power" id="electricity_power" placeholder="Elektrik kapasitesi giriniz" />
        <x-input-error for="electricity_power" class="mt-2" />
    </div>

    <!-- Building Year -->
    <div class="my-4">
        <x-label for="building_year">Bina Yapım Yılı</x-label>
        <x-input type="number" class="w-full" wire:model="building_year" id="building_year" placeholder="Yapım yılını giriniz" />
        <x-input-error for="building_year" class="mt-2" />
    </div>

    <!-- Additional Description -->
    <div class="my-4">
        <x-label for="description">Açıklama</x-label>
        <x-textarea class="w-full" wire:model="description" id="description" placeholder="Ek açıklama giriniz" />
        <x-input-error for="description" class="mt-2" />
    </div>
</div>
