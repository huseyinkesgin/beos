<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Personel Listesi') }}
            </h2>

            @livewire('people.personnel-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('people.personnel-edit')
                @livewire('people.personnel-delete')

                    @livewire('people.personnel-table')

            </div>
        </div>
</div>
