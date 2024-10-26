    <div>
        <!-- resources/views/admin/finance/personnel-balance-table.blade.php -->
        <div class="grid grid-cols-1 gap-6 p-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($personnels as $personnel)
                <div class="p-6 text-gray-300 transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-br from-blue-900 to-blue-950 hover:scale-105">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold">{{ $personnel->first_name }} {{ $personnel->last_name }}</h3>
                        <i class="text-3xl text-orange-500 fas fa-user-circle"></i>
                    </div>
                    <div class="mt-4">
                        <p class="text-lg font-semibold text-gray-400">Son Bakiye:</p>
                        <p class="text-4xl font-extrabold text-orange-500">{{ number_format($personnel->current_balance, 2) }} ₺</p>
                    </div>
                </div>
            @endforeach
        </div>


<div class="flex items-center justify-between mx-5">
    <div class="flex space-x-4">
        <x-paginate />

        <x-filter-trashed />
        <x-filter-date />

           <!-- Personnel Filter -->
           <x-select wire:model.live="personnelId" class="min-w-32">
            <option value="">Tüm Personeller</option>
            @foreach ($personnels as $personnel)
                <option value="{{ $personnel->id }}">{{ $personnel->first_name }} {{ $personnel->last_name }}</option>
            @endforeach
        </x-select>

    </div>
    <x-search />
</div>


    <!-- Kasa İşlemleri Tablosu -->
    <x-table class="min-w-full table-auto">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <x-th>Personel</x-th>
                <x-th>Miktar</x-th>
                <x-th>İşlem</x-th>
                <x-th>İşlem Tarihi</x-th>
                <x-th>Düzenle</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach($balanceRecords as $record)
                <tr>
                    <x-td>{{ $record->personnel->first_name }} {{ $record->personnel->last_name }}</x-td>
                    <x-td>{{ number_format($record->amount, 2) }} ₺</x-td>
                    <x-td>{{ $record->type }}</x-td>
                    <x-td>{{ $record->created_at->format('d.m.Y') }}</x-td>
                    <x-td>
                        @if($record->type !== 'Harcama')
                            <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $record->id }}' })">
                                Düzenle
                            </x-secondary-button>
                            <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $record->id }}' })" class="ml-2">
                                Sil
                            </x-danger-button>
                        @endif
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table>

    {{ $balanceRecords->links() }}

    </div>
