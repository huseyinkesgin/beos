<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kategori Listesi') }}
            </h2>

            <livewire:portfolio.portfolio-create />
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                @livewire('portfolio.portfolio-edit')
                @livewire('portfolio.portfolio-delete')

                <div class="px-2 py-3 shadow-lg bg-gray-50">
                    @livewire('portfolio.portfolio-table')
                </div>

            </div>
        </div>
    </div>
</div>