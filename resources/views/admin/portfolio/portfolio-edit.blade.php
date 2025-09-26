<x-dialog-modal wire:model="open" maxWidth="2xl">
    <x-slot name="title">Portföy Düzenle</x-slot>
    <span class="text-black uppercase">  {{ $portfolio_no }} DÜZENLEME FORMU</span>
    <x-slot name="content">
        <x-form>
            @if ($currentStep == 1)
                @include('admin.portfolio.steps.step-1')
            @elseif ($currentStep == 2)
                @if ($form_path)
                    @include($form_path)
                @else
                    <p>Form yolu bulunamadı.</p>
                @endif
            @elseif ($currentStep == 3)
                @include('admin.portfolio.steps.step-3')
            @elseif ($currentStep == 4)
                @include('admin.portfolio.steps.step-4')
            @elseif ($currentStep == 5)
                @include('admin.portfolio.steps.step-5')
            @endif

            <div class="flex justify-between mt-5">
                @if ($currentStep > 1)
                    <x-secondary-button wire:click="previousStep">Geri</x-secondary-button>
                @endif
                @if ($currentStep < $totalSteps)
                    <x-dark-button wire:click="nextStep">İleri</x-dark-button>
                @else
                    <x-dark-button wire:click="updatePortfolio">Güncelle</x-dark-button>
                @endif
            </div>
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('open')">Vazgeç</x-secondary-button>
    </x-slot>
</x-dialog-modal>
