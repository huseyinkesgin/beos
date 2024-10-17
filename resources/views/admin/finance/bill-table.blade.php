{{-- resources/views/admin/location/state-table.blade.php --}}
<div>
    <!-- Bu Ayın Ödenecek Faturaları -->
    <div class="grid grid-cols-3 gap-4 p-4 mb-5">
        <!-- Bu Ayın Ödenecek Faturaları -->
        <div class="p-4 text-white bg-red-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Bu Ayın Ödenecek Faturaları</h3>
            <p class="text-2xl">{{ number_format($this_month_unpaid_total, 2) }} TL</p>
        </div>

        <!-- Bu Ay Ödenmiş Faturalar -->
        <div class="p-4 text-white bg-green-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Bu Ay Ödenmiş Faturalar</h3>
            <p class="text-2xl">{{ number_format($this_month_paid_total, 2) }} TL</p>
        </div>

        <!-- Bu Yıl Ödenmiş Faturalar -->
        <div class="p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Bu Yıl Ödenmiş Faturalar</h3>
            <p class="text-2xl">{{ number_format($this_year_paid_total, 2) }} TL</p>
        </div>
    </div>





    <div class="flex items-center justify-between mx-5">
        <div class="flex space-x-4">
            <x-paginate />

            <x-filter-trashed />
        </div>
        <x-search />
    </div>

    <x-table>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <x-th>Sıra No</x-th>
                <x-th>
                    <button wire:click="sortBy('id')" class="flex items-center font-bold">
                        ID
                        <span class="ml-1">{!! $this->getSortIcon('id') !!}</span>
                    </button>
                </x-th>
                <x-th>
                    <button wire:click="sortBy('name')" class="flex items-center font-bold">
                        Türü
                        <span class="ml-1">{!! $this->getSortIcon('type') !!}</span>
                    </button>
                </x-th>
                <x-th>Miktar</x-th>
                <x-th>Fatura Tarihi</x-th>
                <x-th>Son Ödeme Tarihi</x-th>
                <x-th>FAtura No</x-th>
                <x-th>Ödeme Yöntemi</x-th>

                <x-th>Ödeme Durumu</x-th>
                <x-th>Ödenme Tarihi</x-th>
                <x-th>Giriş/Güncellenme Tarihi</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @forelse($bills as $index => $bill)
            <tr>
                <x-td>{{ $index +1}}</x-td>
                <x-td>{{ $bill->id }}</x-td>
                <x-td>{{ $bill->type }}</x-td>
                <x-td>
                    <span class="font-bold text-red-500"> {{ $bill->amount }} TL </span>
                </x-td>
                <x-td>{{ $bill->bill_date }}</x-td>
                <x-td>
                    {{ $bill->last_date }}
                </x-td>
                <x-td>
                    {{ $bill->bill_no }}
                </x-td>
                <x-td>
                    {{ $bill->payment_method }}
                </x-td>

                <x-td>
                    <div class="flex items-center space-x-1">
                        @if ($selectedBillId === $bill->id && $showSelectBox)
                        <x-select wire:change="updateStatus({{ $bill->id }}, $event.target.value)"
                                  wire:model.defer="bills.{{ $bill->id }}.status">
                            <option value="Durum">Durum</option>
                            <option value="Ödenecek">Ödenecek</option>
                            <option value="Ödendi">Ödendi</option>
                        </x-select>
                    @else
                        <span wire:click="toggleSelectBox({{ $bill->id }})" class="cursor-pointer">
                            @if ($bill->status === 'Ödenecek')
                                <x-badge-red>Ödenecek</x-badge-red>
                            @elseif ($bill->status === 'Ödendi')
                                <x-badge-green>Ödendi</x-badge-green>
                            @endif
                        </span>
                    @endif

                    </div>
                </x-td>

                <x-td>{{ $bill->payment_date }}</x-td>
                <x-td class="italic">
                    {{ $bill->created_at }} <br>
                    <span class="text-red-600"> {{ $bill->updated_at }}</span>
                    @if ($bill->deleted_at)
                    <br><span class="text-red-600">{{ $state->deleted_at }}</span>
                    @endif

                </x-td>
                <x-td>
                    @if ($deletedFilter === 'only')
                    <x-secondary-button wire:click="restore('{{ $bill->id }}')" wire:loading.attr="disabled">
                        Geri Al
                    </x-secondary-button>
                    <x-danger-button wire:click="forceDelete('{{ $bill->id }}')" wire:loading.attr="disabled"
                        class="ml-2">
                        Kalıcı Sil
                    </x-danger-button>
                    @else
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $bill->id }}' })"
                        wire:loading.attr="disabled">
                        Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $bill->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            Sil
                        </x-danger-button>
                        @endif
                </x-td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-8 text-center">
                    <p class="font-semibold text-red-500">Üzgünüm, herhangi bir veri bulunamadı.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </x-table>


    <div class="m-3">
        {{ $bills->links() }}
    </div>

</div>
