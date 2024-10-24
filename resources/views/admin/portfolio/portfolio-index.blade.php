<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Portföy Listesi') }}
            </h2>

            <livewire:portfolio.portfolio-wizard />
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

            @livewire('portfolio.portfolio-edit')
            @livewire('portfolio.portfolio-delete')
            <livewire:portfolio.portfolio-medias />
            <livewire:portfolio.portfolio-galleries />
            <livewire:portfolio.portfolio-ads />

            @livewire('portfolio.portfolio-table')

        </div>
    </div>
</div>