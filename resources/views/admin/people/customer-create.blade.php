<!-- resources/views/livewire/people/customer-create.blade.php -->
<div>
    <!-- Yeni Müşteri Ekle Butonu -->
    <x-button-orange wire:click="$dispatch('openCreateCustomerModal')"> 
        <i class="mr-2 font-bold text-white cursor-pointer fa-solid fa-plus"></i>
       YENİ MÜŞTERİ OLUŞTUR
    </x-button-orange>

    <!-- Modal -->
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            MÜŞTERİ FORMU
        </x-slot>



        <x-slot name="content">
            <x-form>
                <div class="flex flex-row space-x-3">


                    <!-- Customer Type Radio Buttons -->
                    <div class="flex flex-row mt-5">
                        <div class="w-full mx-5 text-sm">
                            <x-radio-button label="Bireysel" id="bireysel" value="Bireysel" model="customer_type" />
                        </div>
                        <div class="w-full mx-5 text-sm">
                            <x-radio-button label="Kurumsal" id="kurumsal" value="Kurumsal" model="customer_type" />
                        </div>
                    </div>

                    <x-select-box label="Kategori" model="category" :options="['Mal Sahibi','Alıcı','Emlakçı','Partner','Referans']" />


                </div>

                <!-- Company Information - Only visible if corporate type selected -->
                @if ($customer_type == 'Kurumsal')
                <x-input-text label="Firma Adı" model="company_name" />

                <div class="flex flex-row space-x-3">
                    <!-- tax_office -->
                    <x-input-text label="Vergi Dairesi" model="tax_office" />

                    <!-- tax_no -->
                    <x-input-text label="Vergi No" model="tax_no" />

                </div>
                @endif


                <!-- Name -->
                <x-input-email label="İsim Soyisim" model="name" />

                <div class="flex flex-row space-x-3">
                    <!-- Phone -->
                    <x-input-phone label="Telefon" model="phone" />

                    <!-- Email -->
                    <x-input-email label="Eposta" model="email" />
                </div>

                <!-- isActive -->
                <x-select-active />

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
