{{-- views/admin/porfolio/forms/Arsa-form.blade.php --}}

{{-- resources/views/admin/portfolio/forms/Arsa-form.blade.php --}}
<div>
    <!-- Area m² -->
    <div class="my-4">
        <x-label for="area_m2">m²</x-label>
        <x-input type="number" class="w-full" wire:model="area_m2" id="area_m2" placeholder="Alanı m² cinsinden giriniz" />
        <x-input-error for="area_m2" class="mt-2" />
    </div>

    <!-- Zoning Status (İmar Durumu) -->
    <div class="my-4">
        <x-label for="zoning_status">İmar Durumu</x-label>
        <x-select wire:model="zoning_status" id="zoning_status" class="w-full">
            <option value="">Seçiniz</option>
            <option value="Konut">Konut</option>
            <option value="Ticari">Ticari</option>
            <option value="Sanayi">Sanayi</option>
            <option value="Ticari-Konut">Ticari-Konut</option>
        </x-select>
        <x-input-error for="zoning_status" class="mt-2" />
    </div>

    <!-- Similar (Emsal) -->
    <div class="my-4">
        <x-label for="similar">Emsal</x-label>
        <x-select wire:model="similar" id="similar" class="w-full">
            <option value="">Seçiniz</option>
            <option value="0,10">0,10</option>
            <option value="0,20">0,20</option>
            <option value="0,30">0,30</option>
            <option value="0,40">0,40</option>
        </x-select>
        <x-input-error for="similar" class="mt-2" />
    </div>

    <!-- Height Limit (Gabari) -->
    <div class="my-4">
        <x-label for="height_limit">Gabari</x-label>
        <x-select wire:model="height_limit" id="height_limit" class="w-full">
            <option value="">Seçiniz</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
        </x-select>
        <x-input-error for="height_limit" class="mt-2" />
    </div>

    <!-- isCredit (Krediye Uygunluk) -->
    <div class="my-4">
        <x-label for="isCredit">Krediye Uygunluk</x-label>
        <x-select wire:model="isCredit" id="isCredit" class="w-full">
            <option value="">Seçiniz</option>
            <option value="Uygun">Uygun</option>
            <option value="Uygun Değil">Uygun Değil</option>
        </x-select>
        <x-input-error for="isCredit" class="mt-2" />
    </div>

    <!-- Deed Type (Tapu Durumu) -->
    <div class="my-4">
        <x-label for="deed_type">Tapu Durumu</x-label>
        <x-select wire:model="deed_type" id="deed_type" class="w-full">
            <option value="">Seçiniz</option>
            <option value="Kat Mülkiyeti">Kat Mülkiyeti</option>
            <option value="Kat İrtifakı">Kat İrtifakı</option>
            <option value="Hisseli">Hisseli</option>
        </x-select>
        <x-input-error for="deed_type" class="mt-2" />
    </div>

    <!-- Lot and Parcel (Ada, Parsel) -->
    <div class="my-4">
        <x-label for="lot">Ada</x-label>
        <x-input type="text" class="w-full" wire:model="lot" id="lot" placeholder="Ada numarasını giriniz" />
        <x-input-error for="lot" class="mt-2" />
    </div>

    <div class="my-4">
        <x-label for="parcel">Parsel</x-label>
        <x-input type="text" class="w-full" wire:model="parcel" id="parcel" placeholder="Parsel numarasını giriniz" />
        <x-input-error for="parcel" class="mt-2" />
    </div>

    <!-- Property No (Taşınmaz No) -->
    <div class="my-4">
        <x-label for="property_no">Taşınmaz No</x-label>
        <x-input type="text" class="w-full" wire:model="property_no" id="property_no" placeholder="Taşınmaz numarasını giriniz" />
        <x-input-error for="property_no" class="mt-2" />
    </div>

    <!-- Is Swap (Takas Durumu) -->
    <div class="my-4">
        <x-label for="isSwap">Takas Durumu</x-label>
        <x-select wire:model="isSwap" id="isSwap" class="w-full">
            <option value="">Seçiniz</option>
            <option value="Evet">Evet</option>
            <option value="Hayır">Hayır</option>
        </x-select>
        <x-input-error for="isSwap" class="mt-2" />
    </div>

    <!-- Additional Description -->
    <div class="my-4">
        <x-label for="description">Açıklama</x-label>
        <x-textarea class="w-full" wire:model="description" id="description" placeholder="Ek açıklama giriniz" />
        <x-input-error for="description" class="mt-2" />
    </div>
</div>
