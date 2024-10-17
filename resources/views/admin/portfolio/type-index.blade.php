<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Emlak Tipi Listesi') }}
            </h2>

            @livewire('portfolio.type-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">
                @livewire('portfolio.type-edit')
                @livewire('portfolio.type-delete')

                    @livewire('portfolio.type-table')

            </div>
        </div>
</div>
