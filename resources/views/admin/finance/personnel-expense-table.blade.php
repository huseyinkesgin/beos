<div>

    <div class="grid grid-cols-1 gap-6 p-4 mb-5 md:grid-cols-4">
        <!-- Nakit - Bu Ay -->
        <div class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-br from-yellow-500 to-yellow-600 hover:scale-105">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Nakit - Bu Ay</h3>
                <i class="text-2xl fas fa-wallet"></i>
            </div>
            <p class="mt-4 text-3xl font-extrabold">{{ number_format($paymentMethodMonthTotals['Nakit'] ?? 0, 2) }} ₺</p>
        </div>

        <!-- Nakit - Bu Yıl -->
        <div class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-br from-purple-700 to-purple-800 hover:scale-105">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Nakit - Bu Yıl</h3>
                <i class="text-2xl fas fa-coins"></i>
            </div>
            <p class="mt-4 text-3xl font-extrabold">{{ number_format($paymentMethodYearTotals['Nakit'] ?? 0, 2) }} ₺</p>
        </div>

        <!-- Kredi Kartı - Bu Ay -->
        <div class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-br from-red-500 to-red-600 hover:scale-105">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Kredi Kartı - Bu Ay</h3>
                <i class="text-2xl fas fa-credit-card"></i>
            </div>
            <p class="mt-4 text-3xl font-extrabold">{{ number_format($paymentMethodMonthTotals['Kredi Kartı'] ?? 0, 2) }} ₺</p>
        </div>

        <!-- Kredi Kartı - Bu Yıl -->
        <div class="p-6 text-white transition duration-300 transform rounded-lg shadow-lg bg-gradient-to-br from-orange-500 to-orange-600 hover:scale-105">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Kredi Kartı - Bu Yıl</h3>
                <i class="text-2xl fas fa-calendar-alt"></i>
            </div>
            <p class="mt-4 text-3xl font-extrabold">{{ number_format($paymentMethodYearTotals['Kredi Kartı'] ?? 0, 2) }} ₺</p>
        </div>
    </div>

    <!-- Harcama Tablosu -->
    <div class="flex items-center justify-between mx-5">
        <div class="flex space-x-4">
            <x-paginate />
            <x-filter-trashed />
            <x-filter-date />
            
        </div>
        <x-search />
    </div>

    <x-table class="min-w-full table-auto">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <x-th>Personel</x-th>
                <x-th>Mevcut Bakiye</x-th>
                <x-th>Harcama Türü</x-th>
                <x-th>Açıklama</x-th>
                <x-th>Tutar</x-th>
                <x-th>Ödeme Yöntemi</x-th>
                <x-th>Harcama Tarihi</x-th>
                <x-th>Fiş/Fatura</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <x-td>{{ $expense->personnel->first_name }} {{ $expense->personnel->last_name }}</x-td>
                <x-td>

                </x-td>
                <x-td>{{ $expense->expense_type }}</x-td>
                <x-td>{{ $expense->note }}</x-td>
                <x-td>
                    <span class="font-bold text-red-600">{{ number_format($expense->amount, 2) }} ₺</span>
                </x-td>
                <x-td>{{ $expense->payment_method }}</x-td>
                <x-td>{{ $expense->expense_date }}</x-td>
                <x-td>{{ $expense->has_receipt ? 'Evet' : 'Hayır' }}</x-td>
                <x-td>
                    <x-td>
                        @if ($deletedFilter === 'only')
                        <x-secondary-button wire:click="restore('{{ $expense->id }}')" wire:loading.attr="disabled">
                            Geri Al
                        </x-secondary-button>
                        <x-danger-button wire:click="forceDelete('{{ $expense->id }}')" wire:loading.attr="disabled"
                            class="ml-2">
                            Kalıcı Sil
                        </x-danger-button>
                        @else
                        <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $expense->id }}' })"
                            wire:loading.attr="disabled">
                            Düzenle
                            </x-danger-button>
                            <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $expense->id }}' })"
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

    {{ $expenses->links() }}
</div>
