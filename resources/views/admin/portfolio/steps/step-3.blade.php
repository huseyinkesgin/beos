
<div class="flex flex-row mx-4 space-x-2">

    <!-- lot -->
    <x-input-text label="Ada" model="lot" />
    <!-- parcel -->
    <x-input-text label="Parsel" model="parcel" />
    <!-- Portföy No -->
    <x-input-text label="Portföy No" model="portfolio_no" />

</div>

<div class="flex flex-row mx-4 space-x-2">
    <!-- price -->
    <x-input-text label="Ücret" model="price" />


    @if ($status == 'Kiralık')
    <!-- additional_fees -->
    <x-select-box label="Ek Ücret" model="additional_fees"
        :options="['+ KDV','+ Stopaj', 'Bilinmiyor']" />

    <x-input-text label="Depozito" model="deposit" />
    @endif

    @if($status == "Satılık")
    <!-- isCredit -->
    <x-select-box label="Krediye Uygunluk" model="isCredit"
        :options="['Uygun','Uygun Değil','Bilinmiyor']" />

    <!-- Is Swap (Takas Durumu) -->
    <div class="w-full">
        <x-label for="isSwap">Takas Durumu</x-label>
        <x-select wire:model.live="isSwap" id="isSwap" >
            <option value="">Seçiniz</option>
            <option value="1">Evet</option>
            <option value="0">Hayır</option>
        </x-select>
        <x-input-error for="isSwap" class="mt-2" />
    </div>
    @endif
</div>
<div class="flex flex-row mx-4 space-x-2">

    <!-- Property No (Taşınmaz No) -->
    <x-input-text label="Taşınmaz No" model="property_no" />

    <!-- Deed Type (Tapu Durumu) -->
    <x-select-box label="Tapu Durumu" model="deed_type"
        :options="['Kat Mülkiyeti','Kat İrtifakı','Hisseli','Müstakil Tapulu','Arsa Tapulu','Tahsis','Tapu Kaydı Yok']" />


</div>
