<div>
    <div class="grid grid-cols-8 gap-4 p-4 mb-5">
        @foreach (['Market', 'Pazar', 'Ofis', 'Araç', 'Su', 'Diğer'] as $type)
            <!-- Bu Ay Toplamı Widget -->
            <div class="p-4 bg-green-500 rounded-lg shadow-md">
                <h3 class="text-lg font-bold">{{ $type }} - Bu Ay</h3>
                <p class="text-2xl">{{ number_format($thisMonthTotals[$type] ?? 0, 2) }} ₺</p>
            </div>

            <!-- Bu Yıl Toplamı Widget -->
            <div class="p-4 bg-blue-500 rounded-lg shadow-md">
                <h3 class="text-lg font-bold">{{ $type }} - Bu Yıl</h3>
                <p class="text-2xl">{{ number_format($thisYearTotals[$type] ?? 0, 2) }} ₺</p>
            </div>
        @endforeach

         <!-- Nakit Ödeme Yöntemi -->
    <div class="p-4 bg-yellow-500 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">Nakit - Bu Ay</h3>
        <p class="text-2xl">{{ number_format($paymentMethodMonthTotals['Nakit'] ?? 0, 2) }} ₺</p>
    </div>

    <div class="p-4 bg-purple-700 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">Nakit - Bu Yıl</h3>
        <p class="text-2xl">{{ number_format($paymentMethodYearTotals['Nakit'] ?? 0, 2) }} ₺</p>
    </div>

    <!-- Kredi Kartı Ödeme Yöntemi -->
    <div class="p-4 bg-red-500 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">Kredi Kartı - Bu Ay</h3>
        <p class="text-2xl">{{ number_format($paymentMethodMonthTotals['Kredi Kartı'] ?? 0, 2) }} ₺</p>
    </div>

    <div class="p-4 bg-orange-700 rounded-lg shadow-md">
        <h3 class="text-lg font-bold">Kredi Kartı - Bu Yıl</h3>
        <p class="text-2xl">{{ number_format($paymentMethodYearTotals['Kredi Kartı'] ?? 0, 2) }} ₺</p>
    </div>
    </div>
    <div class="flex items-center justify-between mx-5">
        <div class="flex space-x-4">
            <x-paginate />

            <x-filter-trashed />
        </div>
        <x-search />
    </div>

    <x-table class="min-w-full table-auto">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <x-th>Personel</x-th>
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
                <x-td>{{ $expense->personnel->name }}</x-td>
                <x-td>{{ $expense->expense_type }}</x-td>
                <x-td>{{ $expense->note }}</x-td>
                <x-td>
                    <span class="font-bold text-red-600">{{ number_format($expense->amount, 2) }} ₺</span>
                </x-td>
                <x-td>{{ $expense->payment_method }}</x-td>
                <x-td>{{ $expense->expense_date }}</x-td>
                <x-td>{{ $expense->has_receipt ? 'Evet' : 'Hayır' }}</x-td>
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
            </tr>
            @endforeach
        </tbody>
    </x-table>

    {{ $expenses->links() }}
</div>
