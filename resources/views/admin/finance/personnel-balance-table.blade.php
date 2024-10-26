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
            @foreach($balanceRecords as $balance)
            <tr>
                <x-td>{{ $balance->personnel->first_name }} {{ $balance->personnel->last_name }}</x-td>
                <x-td>{{ number_format($balance->cash_in ?? $balance->cash_out, 2) }} ₺</x-td>
                <x-td>{{ $balance->cash_in ? 'Giriş' : 'Çıkış' }}</x-td>
                <x-td>{{ $balance->created_at->format('d.m.Y') }}</x-td>
                <x-td>
                    @if ($balance->cash_in)
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $balance->id }}' })" wire:loading.attr="disabled">
                        Düzenle
                    </x-danger-button>
                    @endif
                </x-td>
            </tr>
              <!-- Personelin nakit harcamalarını kontrol edip ekleme -->
              @foreach ($pers->find($balance->personnel_id)?->expenses ?? [] as $expense)

              @if ($expense->payment_method === 'Nakit')
                  <tr class="text-red-600">
                      <x-td>{{ $balance->personnel->first_name }} {{ $balance->personnel->last_name }}</x-td>
                      <x-td>{{ number_format(-$expense->amount, 2) }} ₺</x-td>
                      <x-td>Harcama</x-td>
                      <x-td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d.m.Y') }}</x-td>
                      <x-td></x-td>
                  </tr>
              @endif
          @endforeach
            @endforeach
        </tbody>
    </x-table>
    {{ $balanceRecords->links() }}

    </div>
