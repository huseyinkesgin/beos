<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Personel Nakit Girişi') }}
            </h2>
           <div class="flex">

            @livewire('finance.personnel-balance-create')

           </div>
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

           @livewire('finance.personnel-balance-edit')
            {{-- @livewire('finance.personnel-balance-delete') --}}
            @livewire('finance.personnel-balance-table')

        </div>
    </div>
</div>
