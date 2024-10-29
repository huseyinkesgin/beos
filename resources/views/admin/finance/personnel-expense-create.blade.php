<div>
    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Harcama
    </x-dark-button>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">Yeni Harcama</x-slot>
        <x-slot name="content">
            <x-form>
                <div class="flex flex-row space-x-3">

                    <!-- personnel_id -->
                    <x-select-boxo label="Personel" model="personnel_id" :options="$personnels" />
                    <!-- payment_method -->
                    <x-select-box label="Ödeme Yöntemi" model="payment_method" :options="['Nakit','Kredi Kartı']" />
                </div>
                <div class="flex flex-row pt-3 space-x-3">
                    <!-- amount -->
                    <x-input-text label="Miktar" model="amount" />
                   <!-- exptense_type -->
                   <x-select-box label="Harcama Türü" model="expense_type" :options="['Market','Pazar','Ofis','Araç','Su','Diğer']" />
                    <!-- note -->
                    <x-input-text label="Açıklama" model="note" />
                </div>
                <div class="flex flex-row pt-3 space-x-3">
                    <!-- expense_date -->
                    <x-input-date label="Harcama Tarihi" model="expense_date" />
                    <!-- has_receipt -->
                    <div class="w-full">
                        <x-label>Fiş Var Mı?</x-label>
                        <x-select wire:model.live='has_receipt'>
                            <option value="">Seçiniz</option>
                            <option value="0">Hayır</option>
                            <option value="1">Evet</option>
                        </x-select>
                        <x-input-error for="has_receipt" />
                    </div>
                </div>
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
