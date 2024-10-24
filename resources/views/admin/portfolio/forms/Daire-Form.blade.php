{{-- resources/views/admin/portfolio/forms/Daire-form.blade.php --}}
<div>
    <!-- Area m² -->
    <x-input-text label="M² Alan" model="area_m2" />
    <!-- Number of Rooms -->
    <x-select-box label="Oda Sayısı" model="room_count" :options="['1+0','1+1','2+1','3+1','3+2','4+1','5+1']" />

    <!-- Floor Level -->
    <div class="my-4">
        <x-label for="floor_level">Kaçıncı Kat</x-label>
        <x-select wire:model="floor_level" id="floor_level" class="w-full">
            <option value="">Seçiniz</option>
            @for ($i = 1; $i <= 20; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
        </x-select>
        <x-input-error for="floor_level" class="mt-2" />
    </div>

    <x-input-text label="Banyo Sayısı" model="bathroom_count" />
    <x-input-text label="Bina Kat Sayısı" model="total_floors" />

    <x-input-text label="Yapım Yılı" model="building_years" />

    <!-- Isıtma Tipi -->
    <x-select-box label="Isıtma Tipi" model="heating_type" :options="['Kombi(Doğalgaz)','Merkezi Sistem','Kat Kaloriferi','Klima','Soba','Yerden Isıtma',
     'Güneş Enerjisi','Isıtma Sistemi Yok','Bilinmiyor']" />


    <!-- Is Furnished -->
    <div class="my-4">
        <x-label for="is_furnished">Eşyalı Mı?</x-label>
        <x-checkbox wire:model.live="is_furnished" id="is_furnished" />
        <x-input-error for="is_furnished" class="mt-2" />
    </div>


</div>