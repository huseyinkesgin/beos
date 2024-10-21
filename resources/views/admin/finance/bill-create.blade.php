{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Fatura Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Yeni Fatura Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="flex flex-row py-3 space-x-3">

                    <!-- type -->
                    <div class="w-full">
                        <x-label for="type" value="Fatura Türü" />
                        <x-select id="type" wire:model.live="type" class="w-full">
                            <option value="">Seçiniz</option>
                            <option value="İnternet Faturası">İnternet Faturası</option>
                            <option value="Doğalgaz Faturası">Doğalgaz Faturası</option>
                            <option value="Elektrik Faturası">Elektrik Faturası</option>
                            <option value="Su Faturası">Su Faturası</option>
                            <option value="Cep Telefonu Faturası">Cep Telefonu Faturası</option>
                            <option value="Sabit Telefon Faturası">Sabit Telefon Faturası</option>
                            <option value="Kira Ödemesi">Kira Ödemesi</option>
                            <option value="Aidat Ödemesi">Aidat Ödemesi</option>
                            <option value="Diğer">Diğer</option>
                        </x-select>
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <!-- amount -->
                    <div class="w-full">
                        <x-label for="amount" value="Miktar" />
                        <x-input type="number" id="amount" wire:model.live="amount" class="w-full" />
                        <x-input-error for="amount" />
                    </div>
                </div>

                <div class="flex flex-row py-3 space-x-3">
                     <!-- bill_date -->
                     <div class="w-full">
                        <x-label for="bill_date" value="Fatura Tarihi" />
                        <x-input type="date" id="bill_date" wire:model.live="bill_date" class="w-full" />
                        <x-input-error for="bill_date" />
                    </div>
                     <!-- last_date -->
                     <div class="w-full">
                        <x-label for="last_date" value="Son Ödeme Tarihi" />
                        <x-input type="date" id="last_date" wire:model.live="last_date" class="w-full" />
                        <x-input-error for="last_date" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                     <!-- bill_no -->
                     <div class="w-full">
                        <x-label for="bill_no" value="Fatura No" />
                        <x-input type="text" id="bill_no" wire:model.live="bill_no" class="w-full uppercase" />
                        <x-input-error for="bill_no" />
                    </div>
                     <!-- payment_method -->
                     <div class="w-full">
                        <x-label for="payment_method" value="Ödeme Yöntemi" />
                        <x-select id="payment_method" wire:model.live="payment_method" class="w-full">
                            <option value="">Seçiniz</option>
                            <option value="Nakit">Nakit</option>
                            <option value="Kredi Kartı">Kredi Kartı</option>
                            <option value="Havale">Havale</option>
                            <option value="Otomatik Ödeme">Otomatik Ödeme</option>
                        </x-select>
                        <x-input-error for="payment_method" class="mt-2" />
                    </div>


                </div>


{{--
                <div class="flex flex-row py-3 space-x-3">
                    <!-- status -->
                    <div class="w-full">
                        <x-label for="status" value="Ödeme Durumu" />
                        <x-select id="status" wire:model.live="status" class="w-full">
                            <option value="">Seçiniz</option>
                            <option value="Ödenecek">Ödenecek</option>

                            <option value="Otomatik Ödeme">Otomatik Ödeme</option>
                        </x-select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                </div> --}}



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
