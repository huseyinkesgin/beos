{{-- resources/views/livewire/location/state-create.blade.php --}}
<div>

    <x-dark-button wire:click="$dispatch('openCreateModal')">
        Yeni Araç Ekle
    </x-dark-button>
    <x-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            Yeni Araç Girişi Yap
        </x-slot>

        <x-slot name="content">
            <x-form>
                <x-input-text label="Marka" id="brand" model="brand" />
                <div class="flex flex-row py-3 space-x-3">
                    <!-- license_plate -->
                    <div class="w-full">
                        <x-label for="license_plate" value="Araç Plakası" />
                        <x-input type="text" id="license_plate" wire:model.live="license_plate" class="w-full" />
                        <x-input-error for="license_plate" />
                    </div>
                    <!-- brand -->
                    <div class="w-full">
                        <x-label for="brand" value="Marka" />
                        <x-input type="text" id="brand" wire:model.live="brand" class="w-full" />
                        <x-input-error for="brand" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- model -->
                    <div class="w-full">
                        <x-label for="model" value="Model" />
                        <x-input type="text" id="model" wire:model.live="model" class="w-full" />
                        <x-input-error for="model" />
                    </div>
                    <!-- year -->
                    <div class="w-full">
                        <x-label for="year" value="Model Yılı" />
                        <x-input type="text" id="year" wire:model.live="year" class="w-full" />
                        <x-input-error for="year" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- purchase_date -->
                    <div class="w-full">
                        <x-label for="purchase_date" value="Satın Alma Tarihi" />
                        <x-input type="date" id="purchase_date" wire:model.live="purchase_date" class="w-full" />
                        <x-input-error for="purchase_date" />
                    </div>
                    <!-- chassis_number -->
                    <div class="w-full">
                        <x-label for="chassis_number" value="Şase No" />
                        <x-input type="text" id="chassis_number" wire:model.live="chassis_number" class="w-full" />
                        <x-input-error for="chassis_number" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- registration_number -->
                    <div class="w-full">
                        <x-label for="registration_number" value="Trafik Tescil No" />
                        <x-input type="text" id="registration_number" wire:model.live="registration_number" class="w-full" />
                        <x-input-error for="registration_number" />
                    </div>
                    <!-- registration_image_path -->
                    <div class="w-full">
                        <x-label for="registration_image_path" value="Ruhsat Resmi Ekle" />
                        <x-input type="file" id="registration_image_path" wire:model.live="registration_image_path" class="w-full" />
                        <x-input-error for="registration_image_path" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- insurance_policy_expiry -->
                    <div class="w-full">
                        <x-label for="insurance_policy_expiry" value="Trafik Tescil No" />
                        <x-input type="text" id="insurance_policy_expiry" wire:model.live="insurance_policy_expiry" class="w-full" />
                        <x-input-error for="insurance_policy_expiry" />
                    </div>
                    <!-- insurance_policy_image_path -->
                    <div class="w-full">
                        <x-label for="insurance_policy_image_path" value="Ruhsat Resmi Ekle" />
                        <x-input type="file" id="model" wire:model.live="insurance_policy_image_path" class="w-full" />
                        <x-input-error for="insurance_policy_image_path" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">
                    <!-- casco_policy_expiry -->
                    <div class="w-full">
                        <x-label for="casco_policy_expiry" value="Trafik Tescil No" />
                        <x-input type="text" id="casco_policy_expiry" wire:model.live="casco_policy_expiry" class="w-full" />
                        <x-input-error for="casco_policy_expiry" />
                    </div>
                    <!-- casco_policy_image_path -->
                    <div class="w-full">
                        <x-label for="casco_policy_image_path" value="Ruhsat Resmi Ekle" />
                        <x-input type="file" id="casco_policy_image_path" wire:model.live="casco_policy_image_path" class="w-full" />
                        <x-input-error for="casco_policy_image_path" />
                    </div>
                </div>
                <div class="flex flex-row py-3 space-x-3">

                    <!-- additional_documents -->
                    <div class="w-full">
                        <x-label for="additional_documents" value="Ruhsat Resmi Ekle" />
                        <x-input type="file" id="additional_documents" wire:model.live="additional_documents" class="w-full" />
                        <x-input-error for="additional_documents" />
                    </div>
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
