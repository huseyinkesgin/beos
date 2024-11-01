{{-- resources/views/admin/portfolio/forms/Fabrika-form.blade.php --}}
<div class="mt-10">
    <!-- Arsa m² -->
    <div class="border rounded-lg shadow-lg bg-slate-50">
        <!-- Area Fields -->
        <div class="flex flex-row mx-4 space-x-2">
            <!-- Area m² -->
            <x-input-text label="Arsa (m²)" model="area_m2" />
            <!-- zoning_status -->
            <x-select-box label="İmar Durumu" model="zoning_status"
                :options="['Sanayi' ,'Ticari', 'Konut','Ticari+Konut','Diğer Tarım','Tarla']" />
        </div>

        <div class="flex flex-row mx-4 space-x-2">

            <!-- Açık Alan -->
            <x-input-text label="Açık Alan (m²)" model="open_area" />

            <!-- Kapalı Alan -->
            <x-input-text label="Kapalı Alan (m²)" model="closed_area" />

            <!-- İşletme Alanı -->
            <x-input-text label="İşletme Alanı (m²)" model="business_area" />

            <!-- Ofis Alanı -->

            <x-input-text label="Ofis Alanı (m²)" model="office_area" />
        </div>

        <!-- Building and Facility Fields -->
        <div class="flex flex-row mx-4 space-x-2">

            <!-- Yükseklik -->
            <x-input-text label="Yükseklik" model="height" />
            <!-- Kat Sayısı -->
            <x-input-text label="Kat Sayısı" model="floor_count" />

            <!-- Kat Seviyesi -->
            <x-select-box label="Kaçıncı Kat" model="floor_level"
                :options="['Zemin' ,'Asma', '1','2','3','4','5','6','7','8']" />
        </div>


        <div class="flex flex-row mx-4 space-x-2">
            <!-- electricity_power -->
            <x-input-text label="Elektrik (KWA)" model="electricity_power" />
            <!-- Yapım Yılı -->
            <x-input-text label="Yapım Yılı" model="building_year" />

            <!-- Isıtma Tipi -->
            <x-select-box label="Isıtma Tipi" model="heating_type" :options="['Kombi(Doğalgaz)','Merkezi Sistem','Kat Kaloriferi','Klima','Soba','Yerden Isıtma',
        'Güneş Enerjisi','Isıtma Sistemi Yok','Bilinmiyor']" />
        </div>

        <div class="flex flex-row mx-4 space-x-2">
            <!-- Yapının Durumu -->
            <div class="flex-1 my-4">
                <x-label for="building_condition">Yapının Durumu</x-label>
                <x-select wire:model.live="building_condition" id="building_condition" class="w-full">
                    <option value="Seçiniz">Seçiniz</option>
                    <option value="Sıfır">Sıfır</option>
                    <option value="İkinci El">İkinci El</option>
                    <option value="İnsa Halinde">İnsa Halinde</option>
                </x-select>
                <x-input-error for="building_condition" class="mt-2" />
            </div>
            <!-- Kullanım Durumu -->
            <div class="flex-1 my-4">
                <x-label for="usage_status">Kullanım Durumu</x-label>
                <x-select wire:model.live="usage_status" id="usage_status" class="w-full">
                    <option value="Seçiniz">Seçiniz</option>
                    <option value="Boş">Boş</option>
                    <option value="Kiracı Var">Kiracı Var</option>
                    <option value="Mal Sahibi Var">Mal Sahibi Var</option>
                </x-select>
                <x-input-error for="usage_status" class="mt-2" />
            </div>
        </div>
        <div class="flex flex-row mx-4 space-x-2">
             <!-- Zemin Etüdü -->
             <div class="flex-1 my-4">
                <x-label for="ground_analysis">Zemin Etüdü</x-label>
                <x-select wire:model.live="ground_analysis" id="ground_analysis" class="w-full">
                    <option value="Seçiniz">Seçiniz</option>
                    <option value="1">Var</option>
                    <option value="0">Yok</option>
                </x-select>
                <x-input-error for="ground_analysis" class="mt-2" />
            </div>

            <div class="flex-1 my-4">
                <x-label for="isCrane">Vinç Var Mı?</x-label>
                <x-select wire:model.live="isCrane" id="isCrane" class="w-full">
                    <option value="Seçiniz">Seçiniz</option>
                    <option value="1">Evet</option>
                    <option value="0">Hayır</option>
                </x-select>
                <x-input-error for="isCrane" class="mt-2" />
            </div>

            <!-- Vinç Açıklaması (Eğer Vinç Var İse) -->
            @if($isCrane == '1')
                <div class="flex-1 my-4">
                    <x-label for="crane_description">Vinç Açıklaması</x-label>
                    <x-input wire:model.live="crane_description" id="crane_description" type="text" class="w-full" />
                    <x-input-error for="crane_description" class="mt-2" />
                </div>
            @endif
        </div>
    </div>
</div>
