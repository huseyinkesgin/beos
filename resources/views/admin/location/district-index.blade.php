<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Bölge Listesi') }}
            </h2>

            @livewire('location.district-create')
        </div>
    </x-slot>


        <div class="mx-auto">
            <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('location.district-edit')
                @livewire('location.district-delete')


                @livewire('location.district-table')


            </div>
        </div>

</div>
