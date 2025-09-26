<div>

    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Fatura
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Yeni Fatura Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="flex flex-row py-3 space-x-3">
                    <x-select-box label="Fatura Türü" model="type"
                        :options="['İnternet Faturası', 'Doğalgaz Faturası', 'Elektrik Faturası', 'Su Faturası', 'Cep Telefonu Faturası', 'Sabit Telefon Faturası', 'Kira Ödemesi', 'Aidat Ödemesi', 'Diğer']" />

                    <!-- amount -->
                    <x-input-number label="Fatura Tutarı" model="amount" />
                </div>

                <div class="flex flex-row py-3 space-x-3">
                    <!-- bill_date -->
                    <x-input-date label="Fatura Tarihi" model="bill_date" />
                    <!-- last_date -->
                    <x-input-date label="Son Ödeme Tarihi" model="last_date" />
                </div>

                <div class="flex flex-row py-3 space-x-3">
                    <!-- bill_no -->
                    <x-input-text label="Fatura No" model="bill_no" class="uppercase" />
                    <!-- payment_method -->
                    <x-select-box label="Ödeme Türü" model="payment_method"
                        :options="['Nakit','Kredi Kartı','Havale','Otomatik Ödeme']" />
                </div>
                   <x-input-date label="Ödeme Tarihi" model="payment_date" />
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
