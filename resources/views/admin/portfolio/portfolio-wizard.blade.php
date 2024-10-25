<div>
    <x-dark-button class="" wire:click="$dispatch('openWizardModal')">Yeni Sihirbaz Ekle</x-dark-button>
    <x-dialog-modal wire:model.live="open" maxWidth="2xl">
        <x-slot name="title">
            Yeni Portföy Oluştur
        </x-slot>

        <x-slot name="content">
            <x-form>
                <!-- Lokasyon ve Emlak Tipi Seçimleri -->
                @if ($currentStep == 1)
                @include('admin.portfolio.steps.step-1')

                <div class="flex pt-8 space-x-1">
                    @livewire('location.state-create')
                    @livewire('location.city-create')

                    @livewire('location.district-create')
                </div>



                @endif


                @if ($currentStep == 2)
                <!-- Dinamik Form Seçimi -->
                @if ($form_path)
                @include($form_path)
                @else
                <p>Form yolu bulunamadı.</p>
                @endif
                @endif

                <!-- Portföy Diğer Bilgiler -->
                @if ($currentStep == 3)
                @include('admin.portfolio.steps.step-3')
                @endif

                <!-- Portföy Mal Sahibi veya Partner Bilgileri, Danışman  -->
                @if ($currentStep == 4)
                @include('admin.portfolio.steps.step-4')

                {{-- <div class="flex pt-8 space-x-1">
                    @livewire('people.customer-create')

                </div> --}}

                @endif

                <!-- Portföy Mal Sahibi veya Partner Bilgileri, Danışman  -->
                @if ($currentStep == 5)
                @include('admin.portfolio.steps.step-5')
                @endif


                <!-- Adım Kontrolleri -->
                <div class="flex justify-between mt-5">
                    @if ($currentStep > 1)
                    <x-secondary-button wire:click="previousStep">Geri</x-secondary-button>
                    @endif

                    @if ($currentStep < $totalSteps) <x-dark-button wire:click="nextStep">İleri</x-dark-button>
                        @else
                        <x-dark-button wire:click="save">Kaydet</x-dark-button>
                        @endif
                </div>

            </x-form>
        </x-slot>

        <x-slot name="footer">
            <div class="space-x-1">
                <x-secondary-button wire:click="$toggle('open')">Vazgeç</x-secondary-button>
                @if ($currentStep > 1)
                <x-secondary-button wire:click="previousStep">Geri</x-secondary-button>
                @endif
                @if ($currentStep < $totalSteps) <x-dark-button wire:click="nextStep">İleri</x-dark-button>
                    @else
                    <x-dark-button wire:click="save">Kaydet</x-dark-button>
                    @endif
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
