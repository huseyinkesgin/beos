{{-- resources/views/admin/portfolio/forms/Fabrika-form.blade.php --}}
<div class="mt-10">
    <!-- Arsa m² -->
    <div class="border rounded-lg shadow-lg bg-slate-50">
        <!-- Area Fields -->
        <div class="flex flex-row mx-4 space-x-2">
            <!-- Portföy No -->
            <div class="flex-1 my-4">
                <x-label for="portfolio_no">Portföy No</x-label>
                <x-input type="number" class="w-full" wire:model.live="portfolio_no" id="portfolio_no" />
                <x-input-error for="portfolio_no" class="mt-2" />
            </div>
            <!-- Arsa Alanı -->
            <div class="flex-1 my-4">
                <x-label for="area_m2">Arsa Alanı (m²)</x-label>
                <x-input type="number" class="w-full" wire:model.live="area_m2" id="area_m2" />
                <x-input-error for="area_m2" class="mt-2" />
            </div>
            <!-- Price -->
            <div class="flex-1 my-4">
                <x-label for="price">Fiyat</x-label>
                <x-input type="number" class="w-full" wire:model.live="price" id="price" />
                <x-input-error for="price" class="mt-2" />
            </div>

            @if ($status == 'Kiralık')
            <div class="flex-1 my-4">
                <x-label for="additional_fees">Ek Ücretler</x-label>
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
                <x-label for="lot">Ada</x-label>
                <x-input type="number" class="w-full" wire:model.live="lot" id="lot" />
                <x-input-error for="lot" class="mt-2" />
            </div>
            <div class="flex-1 my-4">
                <x-label for="parcel">Parsel</x-label>
                <x-input type="number" class="w-full" wire:model.live="parcel" id="parcel" />
                <x-input-error for="parcel" class="mt-2" />
            </div>
            <div class="flex-1 my-4">
                <x-label for="zoning_status">İmar Durumu</x-label>
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

            <!-- Açık Alan -->
            <div class="flex-1 my-4">
                <x-label for="open_area">Açık Alan (m²)</x-label>
                <x-input type="text" class="w-full" wire:model.live="open_area" id="open_area" />
                <x-input-error for="open_area" class="mt-2" />
            </div>

            <!-- Kapalı Alan -->
            <div class="flex-1 my-4">
                <x-label for="closed_area">Kapalı Alan (m²)</x-label>
                <x-input type="text" class="w-full" wire:model.live="closed_area" id="closed_area" />
                <x-input-error for="closed_area" class="mt-2" />
            </div>

            <!-- Açık Alan -->
            <div class="flex-1 my-4">
                <x-label for="business_area">İşletme Alanı (m²)</x-label>
                <x-input type="text" class="w-full" wire:model.live="business_area" id="business_area" />
                <x-input-error for="business_area" class="mt-2" />
            </div>

            <!-- Kapalı Alan -->
            <div class="flex-1 my-4">
                <x-label for="office_area">Kapalı Alan (m²)</x-label>
                <x-input type="text" class="w-full" wire:model.live="office_area" id="office_area" />
                <x-input-error for="office_area" class="mt-2" />
            </div>
        </div>

        <!-- Building and Facility Fields -->
        <div class="flex flex-row mx-4 space-x-2">

            <!-- Yükseklik -->
            <div class="flex-1 my-4">
                <x-label for="height">Yükseklik</x-label>
                <x-input type="text" class="w-full" wire:model.live="height" id="height" />
                <x-input-error for="height" class="mt-2" />
            </div>
            <!-- Kat Sayısı -->
            <div class="flex-1 my-4">
                <x-label for="floor_count">Kat Sayısı</x-label>
                <x-input type="number" class="w-full" wire:model.live="floor_count" id="floor_count" />
                <x-input-error for="floor_count" class="mt-2" />
            </div>

            <!-- Kat Seviyesi -->
            <div class="flex-1 my-4">
                <x-label for="floor_level">Kat Seviyesi</x-label>
                <x-select wire:model.live="floor_level" id="floor_level" class="w-full">
                    <option value="Zemin Kat">Zemin Kat</option>
                    <option value="Asma Kat">Asma Kat</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </x-select>
                <x-input-error for="floor_level" class="mt-2" />
            </div>


        </div>

        <!-- Other Fields -->
        <div class="flex flex-row mx-4 space-x-2">
            <!-- Elektrik KWA -->
            <div class="flex-1 my-4">
                <x-label for="electricity_power">Elektrik (KWA)</x-label>
                <x-input type="number" class="w-full" wire:model.live="electricity_power" id="electricity_power" />
                <x-input-error for="electricity_power" class="mt-2" />
            </div>
            <!-- Yapım Yılı -->
            <div class="flex-1 my-4">
                <x-label for="building_year">Yapım Yılı</x-label>
                <x-input type="number" class="w-full" wire:model.live="building_year" id="building_year" />
                <x-input-error for="building_year" class="mt-2" />
            </div>

            <!-- Isıtma Tipi -->
            <div class="flex-1 my-4">
                <x-label for="heating_type">Isıtma Tipi</x-label>
                <x-select wire:model.live="heading_type" id="headinf_type" class="w-full">
                    <option value="">Seçiniz</option>
                    <option value="Kombi">Kombi</option>
                    <option value="Merkezi Sistem">Merkezi Sistem</option>
                    <option value="Kat Kaloriferi">Kat Kaloriferi</option>
                    <option value="Klima">Klima</option>
                    <option value="Soba">Soba</option>
                    <option value="Yerden Isıtma">Yerden Isıtma</option>
                    <option value="Güneş Enerjisi">Güneş Enerjisi</option>
                    <option value="Isıtma Sistemi Yok">Isıtma Sistemi Yok</option>
                    <option value="Bilinmiyor">Bilinmiyor</option>
                </x-select>
                <x-input-error for="heating_type" class="mt-2" />
            </div>


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


        </div>

        <div class="flex flex-row mx-4 space-x-2">

            <!-- Deed Type (Tapu Durumu) -->
            <div class="flex-1 my-4">
                <x-label for="deed_type">Tapu Durumu</x-label>
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
                <x-label for="property_no">Taşınmaz No</x-label>
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
    </div> <!-- Kapanış div -->
