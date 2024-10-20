<!-- resources/views/admin/location/customer-table.blade.php -->
<div>
    <div class="flex justify-between mx-5">
        <div class="flex space-x-4">
            <x-paginate />
            <x-filter-isactive />
            <x-filter-trashed />
            <x-select wire:model.live="customer_type_filter" class="w-full">
                <option value="">Tümü</option>
                <option value="Bireysel">Bireysel</option>
                <option value="Kurumsal">Kurumsal</option>
            </x-select>
            <x-select wire:model.live="category_filter" class="w-full">
                <option value="">Kategori</option>
                <option value="Mal Sahibi">Mal Sahibi</option>
                <option value="Alıcı">Alıcı</option>
                <option value="Emlakçı">Emlakçı</option>
                <option value="Partner">Partner</option>
                <option value="Referans">Referans</option>
            </x-select>
        </div>
       <div>
        <x-search />
       </div>
    </div>

    <x-table>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <x-th>Sıra No</x-th>
                <x-th>Tip</x-th>
                <x-th>
                    <button wire:click="sortBy('name')" class="flex items-center font-bold">
                        Adı
                        <span class="ml-1">{!! $this->getSortIcon('name') !!}</span>
                    </button>
                </x-th>

                <x-th>Kategori</x-th>
                <x-th>Durum</x-th>
                <x-th>Tarihler</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $customer)
                <tr>
                    <x-td>{{ $index + 1 }}</x-td>
                    <x-td>
                        @if ($customer->customer_type === 'Bireysel')
                            <x-badge-orange>Bireysel</x-badge-orange>
                        @else
                            <x-badge-green>Kurumsal</x-badge-green>
                        @endif
                    </x-td>
                    <x-td>{{ $customer->name }}</x-td>

                    <!-- Customer Type Badge -->



                    <x-td>
                        @if ($customer->category == 'Mal Sahibi')
                        <x-badge-indigo>Mal Sahibi</x-badge-indigo>
                        @elseif ($customer->category == 'Alıcı')
                        <x-badge-green>Alıcı</x-badge-green>
                        @elseif ($customer->category == 'Emlakçı')
                        <x-badge-red>Emlakçı</x-badge-red>
                        @elseif ($customer->category == 'Partner')
                        <x-badge-gray>Partner</x-badge-gray>
                        @elseif ($customer->category == 'Referans')
                        <x-badge-yellow>Referans</x-badge-yellow>
                        @endif

                    </x-td>

                    <x-td>
                        <button wire:click="toggleActive('{{ $customer->id }}')"
                            class="text-xs {{ $customer->isActive ? 'text-green-600' : 'text-red-600' }}">
                            {{ $customer->isActive ? 'Aktif' : 'Pasif' }}
                        </button>
                    </x-td>

                    <x-td class="italic">
                        {{ $customer->created_at }} <br>
                        {{ $customer->updated_at }}
                        @if ($customer->deleted_at)
                            <br><span class="text-red-600">{{ $customer->deleted_at }}</span>
                        @endif
                    </x-td>

                    <x-td>
                        @if ($deletedFilter === 'only')
                            <x-secondary-button wire:click="restore('{{ $customer->id }}')"
                                wire:loading.attr="disabled">
                                Geri Al
                            </x-secondary-button>
                            <x-danger-button wire:click="forceDelete('{{ $customer->id }}')"
                                wire:loading.attr="disabled" class="ml-2">
                                Kalıcı Sil
                            </x-danger-button>
                        @else
                        <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $customer->id }}' })" wire:loading.attr="disabled">
                            Düzenle
                        </x-danger-button>
                            <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $customer->id }}' })"
                                wire:loading.attr="disabled" class="ml-2">
                                Sil
                            </x-danger-button>
                        @endif
                    </x-td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-8 text-center">
                        <p class="font-semibold text-red-500">Üzgünüm, herhangi bir veri bulunamadı.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-table>


        <div class="m-3">
            {{ $customers->links() }}
        </div>

</div>
