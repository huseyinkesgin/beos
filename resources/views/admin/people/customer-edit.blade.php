<!-- resources/views/livewire/people/customer-edit.blade.php -->


<div>
   <!-- Modal -->
   <x-dialog-modal wire:model="open" maxWidth="md">
    <x-slot name="title">
        Yeni Müşteri Oluştur
    </x-slot>



    <x-slot name="content">
        <x-form>
            <div class="flex flex-row space-x-3">


                <!-- Customer Type Radio Buttons -->
                <div class="flex flex-row mt-5">
                    <div class="w-full mx-5 text-sm">
                        <input type="radio" wire:model.live="customer_type" id="Bireysel" class="form-check-input"
                            value="Bireysel">
                        <label for="">{{ __('Bireysel') }}</label>
                    </div>
                    <div class="w-full mx-5 text-sm">
                        <input type="radio" wire:model.live="customer_type" id="Kurumsal"
                            class="form-check-input" value="Kurumsal">
                        <label for="kurumsal">{{ __('Kurumsal') }}</label>
                    </div>
                </div>


                <div class="w-full">
                    <x-label for="category">Kategori</x-label>
                    <x-select class="w-full" wire:model.live="category" id="category">
                        <option value="">Seçiniz</option>
                        <option value="Mal Sahibi">Mal Sahibi</option>
                        <option value="Alıcı">Alıcı</option>
                        <option value="Emlakçı">Emlakçı</option>
                        <option value="Partner">Partner</option>
                        <option value="Referans">Referans</option>
                    </x-select>
                    <x-input-error for="category" class="mt-2" />
                </div>


            </div>

            <!-- Company Information - Only visible if corporate type selected -->
            @if ($customer_type === 'Kurumsal')
                <div class="my-4">
                    <x-label for="company_name">Şirket Adı</x-label>
                    <x-input type="text" class="w-full" wire:model.live="company_name" id="company_name"
                        placeholder="Şirket Adı" />
                    <x-input-error for="company_name" class="mt-2" />
                </div>

                <div class="flex flex-row space-x-3">

                    <div class="w-full">
                        <x-label for="tax_office">Vergi Dairesi</x-label>
                        <x-input type="text" class="w-full" wire:model.live="tax_office" id="tax_office"
                            placeholder="Vergi Dairesi" />
                        <x-input-error for="tax_office" class="mt-2" />
                    </div>

                    <div class="w-full">
                        <x-label for="tax_no">Vergi No</x-label>
                        <x-input type="text" class="w-full" wire:model.live="tax_no" id="tax_no"
                            placeholder="Vergi No" />
                        <x-input-error for="tax_no" class="mt-2" />
                    </div>


                </div>
            @endif

            <!-- Category Dropdown -->


            <!-- Name -->
            <div class="my-4">
                <x-label for="name">Müşteri Adı Soyadı</x-label>
                <x-input type="text" class="w-full" wire:model.live="name" id="name" placeholder="Müşteri Adı Soyadı" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="flex flex-row space-x-3">
                <!-- Phone -->
                <div class="w-full">
                    <x-label for="phone">Telefon</x-label>
                    <x-input type="text" class="w-full" wire:model.live="phone" id="phone"
                        placeholder="Telefon" />
                    <x-input-error for="phone" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="w-full">
                    <x-label for="email">Eposta</x-label>
                    <x-input type="email" class="w-full" wire:model.live="email" id="email"
                        placeholder="Email" />
                    <x-input-error for="email" class="mt-2" />
                </div>
            </div>

            <!-- Address -->
            <div class="my-4">
                <x-label for="address">Adres</x-label>
                <x-input class="w-full" wire:model.live="address" id="address" placeholder="Adres" />
                <x-input-error for="address" class="mt-2" />
            </div>


            <!-- Active Status -->
            <!-- Active Status -->
            <div class="my-4">
                <x-label for="isActive">Aktif Mi?</x-label>
                <x-checkbox wire:model.live="isActive" id="isActive" />
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

