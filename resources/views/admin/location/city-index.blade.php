<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('İlçe Listesi') }}
            </h2>

            @livewire('location.city-create')
        </div>
    </x-slot>

    <div class="mx-auto">
            <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('location.city-edit')
                @livewire('location.city-delete')

                    @livewire('location.city-table')

            </div>
    </div>
</div>
