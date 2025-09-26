<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-black">
                {{ __('İlçe Listesi') }}
            </h2>
            @livewire('location.city-create')
        </div>
    </x-slot>

    <div class="mx-auto my-2">
        <div class="overflow-hidden bg-white ">

            @livewire('location.city-edit')
            @livewire('location.city-delete')
            @livewire('location.city-table')

        </div>
    </div>
</div>
