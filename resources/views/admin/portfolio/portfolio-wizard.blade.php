<div>
    <x-dark-button class="" wire:click="$dispatch('openWizardModal')">Yeni Sihirbaz Ekle</x-dark-button>
    <x-dialog-modal wire:model.live="open">
        <x-slot name="title">
            Yeni Portföy Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>
                <!-- Adım 1: Genel Bilgiler -->
                @if ($currentStep == 1)
                <div class="flex flex-row mx-4 space-x-2">
                    <!-- İl Seçimi -->
                    <x-select-boxo label="İl Seç" model="state_id" :options="$states" />

                    <!-- İlçe Seçimi -->
                    @if (!empty($cities))
                    <x-select-boxo label="İlçe Seç" model="city_id" :options="$cities" />
                    @endif

                    <!-- Bölge Seçimi -->
                    @if (!empty($districts))
                    <x-select-boxo label="Bölge Seç" model="district_id" :options="$districts" />
                    @endif
                </div>

                <div class="flex flex-row mx-4 space-x-2">

                    <x-select-box label="Durum" model="status" :options="['Kiralık','Satılık']" />

                    <x-select-boxo label="Kategori Seç" model="category_id" :options="$categories" />

                    <!-- Type Selection -->
                    @if (!empty($types))
                    <x-select-boxo label="Emlak Tipi Seç" model="type_id" :options="$types" />
                    @endif
                </div>

                @endif

                <!-- Adım 2: Detaylı Bilgiler (Kategoriye göre) -->
                @if ($currentStep == 2)
                <!-- Dinamik Form Seçimi -->
                @if ($form_path)
                @include($form_path)
                @else
                <p>Form yolu bulunamadı.</p>
                @endif
                @endif

                @if ($currentStep == 3)

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
                        <!-- isCredit -->
                        <x-select-box label="Krediye Uygunluk" model="isCredit"
                            :options="['Uygun','Uygun Değil','Bilinmiyor']" />

                        <!-- Is Swap (Takas Durumu) -->
                        <div class="w-full">
                            <x-label for="isSwap">Takas Durumu</x-label>
                            <x-select wire:model.live="isSwap" id="isSwap" class="">
                                <option value="">Seçiniz</option>
                                <option value="1">Evet</option>
                                <option value="0">Hayır</option>
                            </x-select>
                            <x-input-error for="isSwap" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex flex-row mx-4 space-x-2">

                        <!-- Property No (Taşınmaz No) -->
                        <x-input-text label="Taşınmaz No" model="property_no" />

                        <!-- Deed Type (Tapu Durumu) -->
                        <x-select-box label="Tapu Durumu" model="deed_type"
                            :options="['Kat Mülkiyeti','Kat İrtifakı','Hisseli','Müstakil Tapulu','Arsa Tapulu','Tahsis','Tapu Kaydı Yok']" />

                        @if ($status == 'Kiralık')
                        <!-- additional_fees -->
                        <x-select-box label="Ek Ücret" model="additional_fees"
                            :options="['+ KDV','+ Stopaj', 'Bilinmiyor']" />

                        <x-input-text label="Depozito" model="deposit" />
                        @endif

                    </div>

                @endif

                <!-- Adım 3: Son Adım ve Kaydet -->
                @if ($currentStep == 4)
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
                @endif

                <!-- Adım Kontrolleri -->
                <!-- Adım Kontrolleri -->
                <div class="flex justify-between mt-5">
                    @if ($currentStep > 1)
                    <x-secondary-button wire:click="previousStep">Geri</x-secondary-button>
                    @endif

                    @if ($currentStep < $totalSteps) <x-dark-button wire:click="nextStep">İleri</x-dark-button>
                        @else
                        <x-dark-button wire:click="save">Kaydet</x-dark-button>
                        @endif
                </div>

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('open')">Vazgeç</x-secondary-button>
            @if ($currentStep > 1)
            <x-secondary-button wire:click="previousStep">Geri</x-secondary-button>
            @endif
            @if ($currentStep < $totalSteps) <x-dark-button wire:click="nextStep">İleri</x-dark-button>
                @else
                <x-dark-button wire:click="save">Kaydet</x-dark-button>
                @endif
        </x-slot>
    </x-dialog-modal>
</div>