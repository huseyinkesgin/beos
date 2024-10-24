<!-- resources/views/admin/location/personnel-table.blade.php -->
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
                    <button wire:click="sortBy('name')" class="flex items-center font-bold">
                        İsim
                        <span class="ml-1">{!! $this->getSortIcon('name') !!}</span>
                    </button>
                </x-th>

                <x-th>Soyisim</x-th>
                <x-th>Durum</x-th>
                <x-th>Tarihler</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @forelse($personnels as $index => $personnel)
            <tr>
                <x-td>{{ $index + 1 }}</x-td>
                <x-td>
                    {{ $personnel->first_name }}
                </x-td>
                <x-td>{{ $personnel->last_name }}</x-td>

                <!-- Customer Type Badge -->



                <x-td>
                    <button wire:click="toggleActive('{{ $personnel->id }}')"
                        class="text-xs {{ $personnel->isActive ? 'text-green-600' : 'text-red-600' }}">
                        {{ $personnel->isActive ? 'Aktif' : 'Pasif' }}
                    </button>
                </x-td>



                <x-td class="italic">
                    {{ $personnel->hire_date_for_humans }} <br>

                    @if ($personnel->deleted_at)
                    <br><span class="text-red-600">{{ $personnel->deleted_at }}</span>
                    @endif
                </x-td>



                <x-td>
                    @if ($deletedFilter === 'only')
                    <x-secondary-button wire:click="restore('{{ $personnel->id }}')" wire:loading.attr="disabled">
                        Geri Al
                    </x-secondary-button>
                    <x-danger-button wire:click="forceDelete('{{ $personnel->id }}')" wire:loading.attr="disabled"
                        class="ml-2">
                        Kalıcı Sil
                    </x-danger-button>


                    @else
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $personnel->id }}' })"
                        wire:loading.attr="disabled">
                        Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $personnel->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            Sil
                        </x-danger-button>


                        <!-- wire:click ile Show Butonu -->
                        <x-button wire:click="showDetails({{ $personnel->id }})">
                            Detay
                        </x-button>

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
            {{ $personnels->links() }}
        </div>
</div>
