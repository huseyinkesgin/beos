<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Müşteri Listesi') }}
            </h2>

            @livewire('people.customer-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('people.customer-edit')
                @livewire('people.customer-delete')

                    @livewire('people.customer-table')

            </div>
    </div>
</div>
