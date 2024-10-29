{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Araç
    </x-dark-button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni Araç Girişi Yap
        </x-slot>

        <x-slot name="content">
            <x-form>

                <div class="flex flex-row py-3 space-x-3">
                    <!-- license_plate -->
                    <x-input-text label="Araç Plakası" model="license_plate" />
                    <!-- brand -->
                    <x-input-text label="Marka" model="brand" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- model -->
                    <x-input-text label="Model" model="model" />
                    <!-- year -->
                    <x-select-box label="Model Yılı" model="year"
                        :options="['2025','2024','2023','2022','2021','2020','2019','2018','2017']" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- purchase_date -->
                    <x-input-date label="Satın Alma Tarihi" model="purchase_date" />
                    <!-- chassis_number -->
                    <x-input-text label="Şase No" model="chassis_number" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- registration_number -->
                    <x-input-text label="Trafik Tescil No" model="registration_number" />
                    <!-- registration_image_path -->
                    <x-input-file label="Ruhsat Resmi" model="registration_image_path" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- insurance_policy_expiry -->
                    <x-input-date label="Sigorta Bitiş Tarihi" model="insurance_policy_expiry" />
                    <!-- insurance_policy_image_path -->
                    <x-input-file label="Sigorta Poliçe Resmi" model="insurance_policy_image_path" />
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- casco_policy_expiry -->
                    <x-input-date label="Kasko Bitiş Tarihi" model="casco_policy_expiry" />
                    <!-- casco_policy_image_path -->
                    <x-input-file label="Kasko Poliçe Resmi" model="casco_policy_image_path" />
                </div>
                <div class="flex flex-row py-3 space-x-3">

                    <!-- additional_documents -->
                    <x-input-file label="Diğer Dökümanlar" model="additional_documents" />
                </div>
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>