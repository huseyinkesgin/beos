<!-- resources/views/livewire/finance/personnel-balance-create.blade.php -->

<div>
    <!-- Yeni Nakit İşlemi Ekle Butonu -->
    <x-dark-button wire:click="openModal">Nakit Girişi Yap</x-dark-button>

    <!-- Nakit Girişi Modal -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">Nakit Girişi Ekle</x-slot>

        <x-slot name="content">
            <x-form>
                <div class="my-4">
                    <x-label for="personnel_id">Personel</x-label>
                    <x-select wire:model="personnel_id">
                        <option value="">Seçiniz</option>
                        @foreach($personnels as $personnel)
                            <option value="{{ $personnel->id }}">{{ $personnel->first_name }} {{ $personnel->last_name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="personnel_id" />
                </div>

                <div class="my-4">
                    <x-label for="cash_in">Nakit Girişi</x-label>
                    <x-input type="text" wire:model="cash_in" placeholder="Giriş Miktarı" />
                    <x-input-error for="cash_in" />
                </div>


            </x-form>
        </x-slot>

        <x-slot name="footer">
           <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
