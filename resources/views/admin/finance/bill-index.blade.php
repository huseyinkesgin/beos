<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Fatura Listesi') }}
            </h2>
            @livewire('finance.bill-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

            @livewire('finance.bill-edit')
            @livewire('finance.bill-delete')
            @livewire('finance.bill-table')

        </div>
    </div>
</div>
