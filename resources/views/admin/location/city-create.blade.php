{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">
        Yeni İlçe Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni İlçe Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>

                <div class="my-4">
                    <x-label>İl Seç</x-label>
                    <x-select id="state" wire:model="state_id" class="w-full px-4 py-2 rounded">
                        <option value="">Seçiniz</option>
                        @foreach ($states as $state )
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach        
                    </x-select>
                </div>

                <div class="my-4">
                    <x-label>İlçe Adı</x-label>
                    <x-input type="text" class="w-full" placeholder="İlçe adını yazınız" wire:model.live="name" />
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
