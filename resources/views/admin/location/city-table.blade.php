{{-- resources/views/admin/location/city-table.blade.php --}}

<div>
    <div class="flex items-center justify-between mx-5 ">
        <div class="flex space-x-4">
            <x-paginate />
            <x-filter-isactive />
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
                    <button wire:click="sortBy('state_id')" class="flex items-center font-bold">
                        Adı
                        <span class="ml-1">{!! $this->getSortIcon('state_id') !!}</span>
                    </button>
                </x-th>
                <x-th>
                    <button wire:click="sortBy('name')" class="flex items-center font-bold">
                        Adı
                        <span class="ml-1">{!! $this->getSortIcon('name') !!}</span>
                    </button>
                </x-th>
                <x-th>Durum</x-th>
                <x-th>Tarihler</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @forelse($cities as $index => $city)
            <tr>
                <x-td>{{ $cities->firstItem() + $index }}</x-td>
                <x-td>{{ $city->id }}</x-td>
                <x-td>{{ $city->state->name }} </x-td>
                <x-td>{{ $city->name }}</x-td>
                <x-td>
                    <button wire:click="toggleActive('{{ $city->id }}')"
                        class="text-xs {{ $city->isActive ? 'text-green-600' : 'text-red-600' }}">
                        {{ $city->isActive ? 'Aktif' : 'Pasif' }}
                    </button>
                </x-td>
                <x-td class="italic">
                    {{ $city->created_at }} <br>
                    {{ $city->updated_at }}
                    @if ($city->deleted_at)
                    <br><span class="text-red-600">{{ $city->deleted_at }}</span>
                    @endif

                </x-td>
                <x-td>
                    @if ($deletedFilter === 'only')
                    <x-secondary-button wire:click="restore('{{ $city->id }}')" wire:loading.attr="disabled">
                        Geri Al
                    </x-secondary-button>
                    <x-danger-button wire:click="forceDelete('{{ $city->id }}')" wire:loading.attr="disabled"
                        class="ml-2">
                        Kalıcı Sil
                    </x-danger-button>
                    @else
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $city->id }}' })"
                        wire:loading.attr="disabled">
                        Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $city->id }}' })"
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
        {{ $cities->links() }}
    </div>
</div>
