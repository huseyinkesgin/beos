<div>


    <x-dialog-modal wire:model="open">
        <x-slot name="title">Yeni Harcama Düzenle</x-slot>

        <x-slot name="content">
            <x-form>
                <div class="flex flex-row space-x-3">



                    <div class="w-full">
                        <x-label>Personel</x-label>
                        <x-select wire:model.live='personnel_id'>
                            <option value="">Seçiniz</option>
                            @foreach ($personnels as $personnel )
                            <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="personnel_id" />
                    </div>

                    <div class="w-full">
                        <x-label>Ödeme Yöntemi</x-label>
                        <x-select wire:model.live='payment_method'>
                            <option value="">Seçiniz</option>
                            <option value="Nakit">Nakit</option>
                            <option value="Kredi Kartı">Kredi Kartı</option>
                        </x-select>
                        <x-input-error for="payment_method" />
                    </div>

                </div>
                <div class="flex flex-row pt-3 space-x-3">
                    <div class="w-full">
                        <x-label>Tutar</x-label>
                        <x-input type="text" wire:model.live="amount" class="w-full" placeholder="Tutar" />
                        <x-input-error for="amount" />
                    </div>
                    <div class="w-full">
                        <x-label>Harcama Türü</x-label>
                        <x-select wire:model.live='expense_type'>
                            <option value="">Seçiniz</option>
                            <option value="Market">Market</option>
                            <option value="Pazar">Pazar</option>
                            <option value="Ofis">Ofis</option>
                            <option value="Araç">Araç</option>
                            <option value="Su">Su</option>
                            <option value="Diğer">Diğer</option>

                        </x-select>
                        <x-input-error for="expense_type" />
                    </div>
                    <div class="w-full">
                        <x-label>Açıklama</x-label>
                        <x-input type="text" wire:model.live="note" class="w-full"  />
                        <x-input-error for="note" />
                    </div>


                </div>
                <div class="flex flex-row pt-3 space-x-3">
                    <div class="w-full">
                        <x-label>Harcama Tarihi</x-label>
                        <x-input type="date" id="expense_date" wire:model.live="expense_date" class="w-full" />
                        <x-input-error for="expense_date" />
                    </div>

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
