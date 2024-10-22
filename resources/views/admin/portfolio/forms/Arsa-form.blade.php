{{-- resources/views/admin/portfolio/forms/Arsa-form.blade.php --}}
<div class="mt-10">
    <div class="border rounded-lg shadow-lg bg-slate-50">
        <div class="flex flex-row mx-4 space-x-2">
            <!-- Portföy No -->
            <x-input-text label="Portföy No" model="portfolio_no" />

            <!-- Area m² -->
            <x-input-text label="Arsa (m²)" model="area_m2" />

            <!-- price -->
            <x-input-text label="Ücret" model="price" />

            @if ($status == 'Kiralık')
            <!-- additional_fees -->
            <x-select-box label="Ek Ücret" model="additional_fees" :options="['+ KDV','+ Stopaj', 'Bilinmiyor']" />
            @endif
        </div>

        <div class="flex flex-row mx-4 space-x-2">

             <!-- lot -->
             <x-input-text label="Ada" model="lot" />
            <!-- parcel -->
            <x-input-text label="Parsel" model="parcel" />
            <!-- zoning_status -->
            <x-select-box label="İmar Durumu" model="zoning_status" :options="['Sanayi' ,'Ticari', 'Konut','Ticari+Konut','Diğer Tarım','Tarla']" />
        </div>

        <div class="flex flex-row mx-4 space-x-2">
            <!-- Similar (Emsal) -->
            <x-select-box label="Emsal" model="similar" :options="['0,05' ,'0,10', '0,15','0,20','0,24','0,25','0,30','0,35','0,40','0,45','0,50','0,60',
            '0,70','0,75','0,80','0,90','0,95','1,00','1,05','1,10','1,15','1,20','1,25']" />

            <!-- Height Limit (Gabari) -->
            <x-select-box label="Gabari" model="heigh_limit" :options="['3,5','6,5','7,5','8,50','9,50','11,50','12,50','14,50','15,50','18,50','21,50','24,50','27,50','30,50','36,50','Serbest','Bilinmiyor']" />
            <!-- isCredit (Krediye Uygunluk) -->
            <x-select-box label="Krediye Uygunluk" model="heigh_limit" :options="['Uygun','Uygun Değil','Bilinmiyor']" />
        </div>

        <div class="flex flex-row mx-4 space-x-2">

            <!-- Deed Type (Tapu Durumu) -->
            <x-select-box label="Tapu Durumu" model="deed_type" :options="['Kat Mülkiyeti','Kat İrtifakı','Hisseli','Müstakil Tapulu','Arsa Tapulu','Tahsis','Tapu Kaydı Yok']" />
            
            <!-- Is Swap (Takas Durumu) -->
            <div class="flex-1 my-4">
                <x-label for="isSwap">Takas Durumu</x-label>
                <x-select wire:model.live="isSwap" id="isSwap" class="w-full pb-3">
                    <option value="">Seçiniz</option>
                    <option value="1">Evet</option>
                    <option value="0">Hayır</option>
                </x-select>
                <x-input-error for="isSwap" class="mt-2" />
            </div>

            <!-- Property No (Taşınmaz No) -->
            <x-input-text label="Taşınmaz No" model="property_no" />

        </div>

        @if ($status == 'Kiralık')
        <x-input-text label="Depozito" model="deposito" />
        @endif
        {{-- MAL SAHİBİ --}}
        <div class="flex flex-row justify-between mx-4">

            <div class="flex-1 my-4">
                <x-label for="owner_customer_id">Mal Sahibi Seç</x-label>
                <x-select wire:model.live="owner_customer_id" id="owner_customer_id" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="0">Bilinmiyor</option>
                    @foreach ($ownerList as $owner)
                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="owner_customer_id" class="mt-2" />

            </div>
        </div>
        <div class="flex flex-row justify-between mx-4">

            {{-- PARTNER VAR MI --}}
            <div class="flex-1 my-4">
                <x-label for="has_partner" class="mr-2">Partner Var Mı?</x-label>
                <x-checkbox wire:model.live="has_partner" id="has_partner" />
                <x-input-error for="has_partner" class="mt-2" />
            </div>
        </div>


        @if ($has_partner || $owner_customer_id == '0')
        <div class="flex flex-row justify-between mx-4">
            <div class="flex-1 my-4">
                <x-label for="partner_customer_id">Partner Seç</x-label>
                <x-select wire:model.live="partner_customer_id" id="partner_customer_id" class="w-full">
                    <option value="">Seçiniz</option>
                    @if (!empty($partnerList))
                    @foreach ($partnerList as $partner)
                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                    @endforeach
                    @endif
                </x-select>
                <x-input-error for="partner_customer_id" class="mt-2" />
            </div>
        </div>
        @endif


    </div>
