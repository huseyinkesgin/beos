<div>
    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">
        Yeni Personel Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni Personel Oluştur
        </x-slot>
        <x-slot name="content">
            <x-form>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- Personel Bilgileri -->
                    <div class="w-full">
                        <x-label for="first_name" value="İsim" />
                        <x-input type="text" id="first_name" wire:model.live="first_name" class="w-full" />
                        <x-input-error for="first_name" />
                    </div>

                    <div class="w-full">
                        <x-label for="last_name" value="Soyisim" />
                        <x-input class="w-full" type="text" id="last_name" wire:model.live="last_name" />
                        <x-input-error for="last_name" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <div class="w-full">
                        <x-label for="email" value="E-posta" />
                        <x-input class="w-full" type="email" id="email" wire:model.live="email" />
                        <x-input-error for="email" />
                    </div>

                    <div class="w-full">
                        <x-label for="phone" value="Telefon" />
                        <x-input class="w-full" type="text" id="phone" wire:model.live="phone" />
                        <x-input-error for="phone" />
                    </div>
                </div>

                <div class="w-full">
                    <x-label for="job_title" value="Ünvan" />
                    <x-input class="w-full" type="text" id="job_title" wire:model.live="job_title" />
                    <x-input-error for="job_title" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <div class="w-full">
                        <x-label for="hire_date" value="İşe Başlama Tarihi" />
                        <x-input class="w-full" type="date" id="hire_date" wire:model.live="hire_date" />
                        <x-input-error for="hire_date" />
                    </div>
                    <!-- termination_date -->
                    <div class="w-full">
                        <x-label for="termination_date">İşten Ayrılış Tarihi</x-label>
                        <x-input type="date" class="w-full" wire:model.live="termination_date" id="termination_date" />
                        <x-input-error for="termination_date" class="mt-2" />
                    </div>
                </div>
                <!-- Adres Bilgileri -->
              

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
