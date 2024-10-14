{{-- resources/views/admin/portfolio/forms/Arsa-form.blade.php --}}
<div class="mt-10">
    <div class="border rounded-lg shadow-lg bg-slate-50">
        <div class="flex flex-row mx-4 space-x-2">
            <!-- Portföy No -->
            <div class="flex-1 my-4">
                <x-label for="portfolio_no">Portföy No <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="portfolio_no" id="portfolio_no" />
                <x-input-error for="portfolio_no" class="mt-2" />
            </div>

            <!-- Area m² -->
            <div class="flex-1 my-4">
                <x-label for="area_m2">m² <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="area_m2" id="area_m2" />
                <x-input-error for="area_m2" class="mt-2" />
            </div>

            <!-- Price -->
            <div class="flex-1 my-4">
                <x-label for="price">Fiyat <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="price" id="price" />
                <x-input-error for="price" class="mt-2" />
            </div>

            @if ($status == 'Kiralık')
            <div class="mt-10">

                <x-select wire:model.live="additional_fees" id="additional_fees" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="+ KDV">+ KDV</option>
                    <option value="+ Stopaj">+ Stopaj</option>
                    <option value="Bilinmiyor">Bilinmiyor</option>
                </x-select>
                <x-input-error for="additional_fees" class="mt-2" />
            </div>
            @endif
        </div>

        <div class="flex flex-row mx-4 space-x-2">
            <div class="flex-1 my-4">
                <x-label for="lot">Ada <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="lot" id="lot" />
                <x-input-error for="lot" class="mt-2" />
            </div>
            <div class="flex-1 my-4">
                <x-label for="parcel">Parsel <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="parcel" id="parcel" />
                <x-input-error for="parcel" class="mt-2" />
            </div>
            <div class="flex-1 my-4">
                <x-label for="zoning_status">İmar Durumu <x-red-star /></x-label>
                <x-select wire:model.live="zoning_status" id="zoning_status" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="Konut">Konut</option>
                    <option value="Ticari">Ticari</option>
                    <option value="Ticari-Konut">Ticari-Konut</option>
                    <option value="Sanayi">Sanayi</option>
                    <option value="Depo&Antrepo">Depo&Antrepo</option>
                    <option value="Tarla">Tarla</option>
                    <option value="A-Lejantlı">A-Lejantlı</option>
                    <option value="Diğer Tarım">Diğer Tarım</option>
                </x-select>
                <x-input-error for="zoning_status" class="mt-2" />
            </div>
        </div>




        <div class="flex flex-row mx-4 space-x-2">
            <!-- Similar (Emsal) -->
            <div class="flex-1 my-4">
                <x-label for="similar">Emsal</x-label>
                <x-select wire:model.live="similar" id="similar" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="0,10">0,10</option>
                    <option value="0,20">0,20</option>
                    <option value="0,30">0,30</option>
                    <option value="0,40">0,40</option>
                </x-select>
                <x-input-error for="similar" class="mt-2" />
            </div>

            <!-- Height Limit (Gabari) -->
            <div class="flex-1 my-4">
                <x-label for="height_limit">Gabari</x-label>
                <x-select wire:model.live="height_limit" id="height_limit" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </x-select>
                <x-input-error for="height_limit" class="mt-2" />
            </div>
            <!-- isCredit (Krediye Uygunluk) -->
            <div class="flex-1 my-4">
                <x-label for="isCredit">Krediye Uygunluk</x-label>
                <x-select wire:model.live="isCredit" id="isCredit" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="1">Uygun</option>
                    <option value="0">Uygun Değil</option>
                </x-select>
                <x-input-error for="isCredit" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-row mx-4 space-x-2">

            <!-- Deed Type (Tapu Durumu) -->
            <div class="flex-1 my-4">
                <x-label for="deed_type">Tapu Durumu <x-red-star /></x-label>
                <x-select wire:model.live="deed_type" id="deed_type" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="Kat Mülkiyeti">Kat Mülkiyeti</option>
                    <option value="Kat İrtifakı">Kat İrtifakı</option>
                    <option value="Hisseli">Hisseli</option>
                    <option value="Müstakil Tapulu">Müstakil Tapulu</option>
                    <option value="Arsa Tapulu">Arsa Tapulu</option>
                    <option value="Tahsis">Tahsis</option>
                    <option value="Tapu Kaydı Yok">Tapu Kaydı Yok</option>
                </x-select>
                <x-input-error for="deed_type" class="mt-2" />
            </div>

            <!-- Is Swap (Takas Durumu) -->
            <div class="flex-1 my-4">
                <x-label for="isSwap">Takas Durumu</x-label>
                <x-select wire:model.live="isSwap" id="isSwap" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="1">Evet</option>
                    <option value="0">Hayır</option>
                </x-select>
                <x-input-error for="isSwap" class="mt-2" />
            </div>

            <!-- Property No (Taşınmaz No) -->
            <div class="flex-1 my-4">
                <x-label for="property_no">Taşınmaz No <x-red-star /></x-label>
                <x-input type="text" class="w-full" wire:model.live="property_no" id="property_no"
                    placeholder="Taşınmaz numarasını giriniz" />
                <x-input-error for="property_no" class="mt-2" />
            </div>

        </div>

        @if ($status == 'Kiralık')
        <div class="flex flex-row mx-4 space-x-2">
            <div class="flex-1 my-4">
                <x-label for="deposit">Depozito</x-label>
                <x-input type="text" wire:model.live="deposit" id="deposit" class="w-full" />
                <x-input-error for="deposit" class="mt-2" />
            </div>
        </div>
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
