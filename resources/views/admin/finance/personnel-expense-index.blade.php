<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Personel Ofis Harcamaları') }}
            </h2>
            @livewire('finance.personnel-expense-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

            @livewire('finance.personnel-expense-edit')
            @livewire('finance.personnel-expense-delete')
            @livewire('finance.personnel-expense-table')

        </div>
    </div>
</div>
