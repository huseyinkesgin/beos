<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('İl Listesi') }}
            </h2>
            @livewire('location.state-create')
        </div>
    </x-slot>

   <div class="mx-auto my-2">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">

                @livewire('location.state-edit')
                @livewire('location.state-delete')
                @livewire('location.state-table')
                @livewire('location.city-add-modal')

            </div>
    </div>
</div>
