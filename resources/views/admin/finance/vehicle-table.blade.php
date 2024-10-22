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
                        Plaka
                        <span class="ml-1">{!! $this->getSortIcon('type') !!}</span>
                    </button>
                </x-th>
                <x-th>Marka</x-th>
                <x-th>Model</x-th>
                <x-th>Yıl</x-th>
                <x-th>Şase No</x-th>
                <x-th>Tescil No</x-th>
                <x-th>Satın Alma Tarihi</x-th>
                <x-th>Sigorta Bitiş</x-th>
                <x-th>Kasko Bitiş</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $index => $vehicle)
            <tr>
                <x-td>{{ $index +1}}</x-td>
                <x-td>{{ $vehicle->id }}</x-td>
                <x-td>{{ $vehicle->license_plate }}</x-td>




                <x-td>{{ $vehicle->brand }}</x-td>
                <x-td>{{ $vehicle->model }}</x-td>
                <x-td>{{ $vehicle->year }}</x-td>
                <x-td>{{ $vehicle->chassis_number }}</x-td>
                <x-td>{{ $vehicle->registration_number }}</x-td>
                <x-td>{{ $vehicle->purchase_date }}</x-td>
                <x-td>{{ $vehicle->insurance_policy_expiry }}</x-td>
                <x-td>{{ $vehicle->casco_policy_expiry }}</x-td>
                <x-td>
                    @if ($deletedFilter === 'only')
                    <x-secondary-button wire:click="restore('{{ $vehicle->id }}')" wire:loading.attr="disabled">
                        Geri Al
                    </x-secondary-button>
                    <x-danger-button wire:click="forceDelete('{{ $vehicle->id }}')" wire:loading.attr="disabled"
                        class="ml-2">
                        Kalıcı Sil
                    </x-danger-button>
                    @else
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $vehicle->id }}' })"
                        wire:loading.attr="disabled">
                        Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $vehicle->id }}' })"
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
        {{ $vehicles->links() }}
    </div>

</div>
