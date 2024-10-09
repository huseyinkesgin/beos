<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('İlçe Listesi') }}
            </h2>
            
            @livewire('location.city-create')
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @livewire('location.city-edit')
                @livewire('location.city-delete')

                <div class="shadow-lg px-2 py-3 bg-gray-50">
                    @livewire('location.city-table')
                </div>

            </div>
        </div>
    </div>
</div>