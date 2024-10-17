<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Kategori Listesi') }}
            </h2>

            <livewire:portfolio.category-create />
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('portfolio.category-edit')
                @livewire('portfolio.category-delete')

                    @livewire('portfolio.category-table')

            </div>
        </div>
</div>
