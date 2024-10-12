{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">
        Yeni Bölge Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni Bölge Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>

                <div class="my-4">
                    <x-label>İl Seç</x-label>
                    <x-select wire:model.live="selectedState" class="w-full px-4 py-2 rounded">
                        <option value="">Seçiniz</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="my-4">
                    <x-label>İlçe Seç</x-label>
                    <x-select id="city_id" wire:model.live="city_id" class="w-full px-4 py-2 rounded">
                        <option value="">Seçiniz</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div class="my-4">
                    <x-label>Bölge Adı</x-label>
                    <x-input type="text" class="w-full" placeholder="Bölge adını yazınız" wire:model.live="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <div class="my-4">
                    <x-label>Durum</x-label>
                    <x-select id="isActive" wire:model="isActive" class="w-full px-4 py-2 border rounded">
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </x-select>
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