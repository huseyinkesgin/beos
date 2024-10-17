
<div>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni Adres Ekle
        </x-slot>
        <x-slot name="content">
            <x-form>

                <div class="flex flex-row mx-4 space-x-2">
                    <!-- İl Seçimi -->
                    <div class="flex-1 my-4">
                        <x-label for="state_id">İl</x-label>
                        <x-select wire:model.live="state_id" id="state_id" class="w-full">
                            <option value="">Seçiniz</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="state_id" class="mt-2" />
                    </div>

                    <!-- İlçe Seçimi -->
                    @if (!empty($cities))
                        <div class="flex-1 my-4">
                            <x-label for="city_id">İlçe</x-label>
                            <x-select wire:model.live="city_id" id="city_id" class="w-full">
                                <option value="">Seçiniz</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="city_id" class="mt-2" />
                        </div>
                    @endif

                    <!-- Bölge Seçimi -->
                    @if (!empty($districts))
                        <div class="flex-1 my-4">
                            <x-label for="district_id">Bölge</x-label>
                            <x-select wire:model.live="district_id" id="district_id" class="w-full">
                                <option value="">Seçiniz</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="district_id" class="mt-2" />
                        </div>
                    @endif
                </div>


                <div class="w-full">
                    <x-label for="address_type" value="Adres Tipi" />
                    <x-select class="w-full" id="address_type" wire:model.live="address_type">
                        <option value="home">Ev</option>
                        <option value="work">İş</option>
                        <option value="depot">Depo</option>
                    </x-select>
                </div>



                <div class="w-full">
                    <x-label for="address_line1" value="Adres Satırı 1" />
                    <x-input class="w-full" type="text" id="address_line1" wire:model.live="address_line1" />
                    <x-input-error for="address_line1" />
                </div>

                <div class="w-full">
                    <x-label for="address_line2" value="Adres Satırı 2" />
                    <x-input class="w-full" type="text" id="address_line2" wire:model.live="address_line2" />
                    <x-input-error for="address_line2" />
                </div>



                <div class="w-full">
                    <x-label for="postal_code" value="Posta Kodu" />
                    <x-input class="w-full" type="text" id="postal_code" wire:model.live="postal_code" />
                </div>

                <div class="w-full">
                    <x-label for="is_default" value="Varsayılan Adres" />
                    <x-checkbox id="is_default" wire:model.live="is_default" />
                </div>

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <div>
                <x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
                    Vazgeç
                </x-secondary-button>
                <x-button wire:click="save">Kaydet</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>


</div>
