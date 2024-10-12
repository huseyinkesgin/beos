<div>
    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">Yeni Portföy Ekle</x-dark-button>

    <x-dialog-modal wire:model.live="open">
        <x-slot name="title">
            Yeni Portföy Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="border rounded-lg shadow-lg bg-slate-50">
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

                    <div class="flex flex-row mx-4 space-x-2">

                        <div class="flex-1 my-4">
                            <x-label for="status">Satılık mı, Kiralık mı?</x-label>
                            <x-select wire:model.live="status" id="status" class="w-full">
                                <option value="Satılık">Satılık</option>
                                <option value="Kiralık">Kiralık</option>
                            </x-select>
                            <x-input-error for="status" class="mt-2" />
                        </div>

                        <div class="flex-1 my-4">
                            <x-label for="category_id">Kategori Seç</x-label>
                            <x-select wire:model.live="category_id" id="category_id" class="w-full">
                                <option value="">Seçiniz</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                @empty($categories)
                                    <option value="">No categories found</option>
                                @endempty
                            </x-select>
                        </div>

                        <!-- Type Selection -->
                        @if (!empty($types))
                            <div class="flex-1 my-4">
                                <x-label for="type_id">Tip Seç</x-label>
                                <x-select wire:model.live="type_id" id="type_id" class="w-full">
                                    <option value="">Seçiniz</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Dynamic Form Inclusion -->
                @if ($form_path)
                    @include($form_path)
                @endif
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Vazgeç
            </x-secondary-button>
            <x-button wire:click="save">Kaydet</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
