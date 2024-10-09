 {{-- resources/views/admin/portfolio/category-table.blade.php --}}

 <div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex space-x-4">
            <x-select wire:model.live="activeFilter" class="w-20">
                <option value="all">Tümü</option>
                <option value="active">Aktif</option>
                <option value="inactive">Pasif</option>
            </x-select>
            <x-select wire:model.live="deletedFilter" class="w-32">
                <option value="without">Güncel</option>
                {{-- <option value="with">Hepsi</option> --}}
                <option value="only">Silinmiş</option>
            </x-select>
        </div>
        <x-input type="text" wire:model.live.debounce.300ms="search" placeholder="Ara..." />
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
            @forelse($categories as $index => $category)
                <tr>
                    <x-td>{{ $categories->firstItem() + $index }}</x-td>
                    <x-td>{{ $category->id }}</x-td>
                    <x-td>{{ $category->name }}</x-td>
                    <x-td>
                        <button wire:click="toggleActive('{{ $category->id }}')" class="text-xs {{ $category->isActive ? 'text-green-600' : 'text-red-600' }}">
                            {{ $category->isActive ? 'Aktif' : 'Pasif' }}
                        </button>
                    </x-td>
                    <x-td class="italic">
                        {{ $category->created_at }} <br>
                        {{ $category->updated_at }}
                        @if ($category->deleted_at)
                            <br><span class="text-red-600">{{ $category->deleted_at }}</span>
                        @endif

                    </x-td>
                    <x-td>
                        @if ($deletedFilter === 'only')
                        <x-secondary-button wire:click="restore('{{ $category->id }}')" wire:loading.attr="disabled">
                            Geri Al
                        </x-secondary-button>
                        <x-danger-button wire:click="forceDelete('{{ $category->id }}')" wire:loading.attr="disabled" class="ml-2">
                            Kalıcı Sil
                        </x-danger-button>
                    @else
                        <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $category->id }}' })" wire:loading.attr="disabled">
                            Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $category->id }}' })" wire:loading.attr="disabled" class="ml-2">
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

    <div class="flex items-center justify-between pt-5">
        <!-- Sol Taraf: Show ve Sayfa Seçici -->
        <div class="flex items-center space-x-2">
            <x-select wire:model.live="pagination" class="w-16">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </x-select>
        </div>
        <div class="ml-4">
            {{ $categories->links() }}
        </div>
    </div>

</div>
