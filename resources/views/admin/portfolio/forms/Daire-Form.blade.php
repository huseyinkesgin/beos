{{-- resources/views/admin/portfolio/forms/Daire-form.blade.php --}}
<div>
    <!-- Area m² -->
    <div class="my-4">
        <x-label for="area_m2">m²</x-label>
        <x-input type="number" class="w-full" wire:model="area_m2" id="area_m2" placeholder="Alanı m² cinsinden giriniz" />
        <x-input-error for="area_m2" class="mt-2" />
    </div>

    <!-- Number of Rooms -->
    <div class="my-4">
        <x-label for="room_count">Oda Sayısı</x-label>
        <x-select wire:model="room_count" id="room_count" class="w-full">
            <option value="">Seçiniz</option>
            <option value="1+1">1+1</option>
            <option value="2+1">2+1</option>
            <option value="3+1">3+1</option>
            <option value="4+1">4+1</option>
            <option value="5+1">5+1</option>
        </x-select>
        <x-input-error for="room_count" class="mt-2" />
    </div>

    <!-- Floor Level -->
    <div class="my-4">
        <x-label for="floor_level">Kaçıncı Kat</x-label>
        <x-select wire:model="floor_level" id="floor_level" class="w-full">
            <option value="">Seçiniz</option>
            @for ($i = 1; $i <= 20; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </x-select>
        <x-input-error for="floor_level" class="mt-2" />
    </div>

    <!-- Number of Floors -->
    <div class="my-4">
        <x-label for="total_floors">Toplam Kat Sayısı</x-label>
        <x-input type="number" class="w-full" wire:model="total_floors" id="total_floors" placeholder="Binanın kat sayısını giriniz" />
        <x-input-error for="total_floors" class="mt-2" />
    </div>

    <!-- Is Furnished -->
    <div class="my-4">
        <x-label for="is_furnished">Eşyalı Mı?</x-label>
        <x-checkbox wire:model="is_furnished" id="is_furnished" />
        <x-input-error for="is_furnished" class="mt-2" />
    </div>

    <!-- Additional Description -->
    <div class="my-4">
        <x-label for="description">Açıklama</x-label>
        <x-textarea class="w-full" wire:model="description" id="description" placeholder="Ek açıklama giriniz" />
        <x-input-error for="description" class="mt-2" />
    </div>
</div>
