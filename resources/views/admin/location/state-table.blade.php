 {{-- resources/views/admin/location/state-table.blade.php --}}

<div>
    <div class="flex items-center justify-between mx-5">
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
            @forelse($states as $index => $state)
                <tr>
                    <x-td>{{ $states->firstItem() + $index }}</x-td>
                    <x-td>{{ $state->id }}</x-td>
                    <x-td>{{ $state->name }}</x-td>
                    <x-td>
                        <button wire:click="toggleActive('{{ $state->id }}')" class="text-xs {{ $state->isActive ? 'text-green-600' : 'text-red-600' }}">
                            {{ $state->isActive ? 'Aktif' : 'Pasif' }}
                        </button>
                    </x-td>
                    <x-td class="italic">
                        {{ $state->created_at }} <br>
                        {{ $state->updated_at }}
                        @if ($state->deleted_at)
                            <br><span class="text-red-600">{{ $state->deleted_at }}</span>
                        @endif

                    </x-td>
                    <x-td>
                        @if ($deletedFilter === 'only')
                        <x-secondary-button wire:click="restore('{{ $state->id }}')" wire:loading.attr="disabled">
                            Geri Al
                        </x-secondary-button>
                        <x-danger-button wire:click="forceDelete('{{ $state->id }}')" wire:loading.attr="disabled" class="ml-2">
                            Kalıcı Sil
                        </x-danger-button>
                    @else
                        <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $state->id }}' })" wire:loading.attr="disabled">
                            Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $state->id }}' })" wire:loading.attr="disabled" class="ml-2">
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
            {{ $states->links() }}
        </div>

</div>
