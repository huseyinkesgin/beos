<div>
    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">
        Yeni Personel Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Yeni Personel Oluştur
        </x-slot>
        <x-slot name="content">
            <x-form>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- first_name -->
                    <x-input-text label="İsim" model="first_name" />
                    <!-- last_name -->
                    <x-input-text label="Soyisim" model="last_name" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- email -->
                    <x-input-email label="Eposta" model="email" />

                    <!-- phone -->
                    <x-input-text label="Telefon" model="phone" />
                </div>


                <div class="flex flex-row py-3 space-x-3">
                    <!-- job_title -->
                    <x-input-text label="Ünvan" model="job_title" />

                    <!-- hire_date -->
                    <x-input-date label="Giriş Tarihi" model="hire_date" />
                </div>

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
