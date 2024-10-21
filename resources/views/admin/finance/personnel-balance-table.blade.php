    <div>
        <!-- resources/views/admin/finance/personnel-balance-table.blade.php -->

        <!-- resources/views/livewire/finance/personnel-balance-widget.blade.php -->
<div class="grid grid-cols-3 gap-4 p-4">
    @foreach ($personnels as $personnel)
        <div class="p-4 bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-lg font-bold">{{ $personnel->first_name }} {{ $personnel->last_name }}</h3>
            <p class="text-2xl">
                {{ number_format($personnel->current_balance, 2) }} ₺
            </p>
        </div>
    @endforeach
</div>

<div class="flex items-center justify-between mx-5">
    <div class="flex space-x-4">
        <x-paginate />

        <x-filter-trashed />
        <x-filter-date />
    </div>
    <x-search />
</div>
    <!-- Nakit işlemleri tablosu -->
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
            @foreach($balanceRecords as $balance)
            <tr>
                <x-td>{{ $balance->personnel->first_name }} {{ $balance->personnel->last_name }}</x-td>
                <x-td>{{ number_format($balance->cash_in ?? $balance->cash_out, 2) }} ₺</x-td>
                <x-td>{{ $balance->cash_in ? 'Giriş' : 'Çıkış' }}</x-td>
                <x-td>{{ $balance->created_at->format('d.m.Y') }}</x-td>
                <x-td>
                    <x-td>
                        @if ($deletedFilter === 'only')
                        <x-secondary-button wire:click="restore('{{ $balance->id }}')" wire:loading.attr="disabled">
                            Geri Al
                        </x-secondary-button>
                        <x-danger-button wire:click="forceDelete('{{ $balance->id }}')" wire:loading.attr="disabled"
                            class="ml-2">
                            Kalıcı Sil
                        </x-danger-button>
                        @else
                        <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $balance->id }}' })"
                            wire:loading.attr="disabled">
                            Düzenle
                            </x-danger-button>
                            <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $balance->id }}' })"
                                wire:loading.attr="disabled" class="ml-2">
                                Sil
                            </x-danger-button>
                            @endif
                    </x-td>
                </x-td>
            </tr>
            @endforeach
        </tbody>
    </x-table>

    {{ $balanceRecords->links() }}

    </div>
