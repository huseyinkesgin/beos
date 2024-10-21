<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Araç Listesi') }}
            </h2>
            @livewire('finance.vehicle-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

            @livewire('finance.vehicle-edit')
            @livewire('finance.vehicle-delete')
            @livewire('finance.vehicle-table')

        </div>
    </div>
</div>
