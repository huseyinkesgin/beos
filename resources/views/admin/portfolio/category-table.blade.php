{{-- resources/views/admin/portfolio/category-table.blade.php --}}

<div>
     <!-- Widgetlar -->
     <div class="grid grid-cols-3 gap-4 p-4 mb-5">
        <!-- Satılık Fabrika Sayısı -->
        <div class="p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Satılık Fabrika Sayısı</h3>
            <p class="text-2xl">{{ $satilikFabrikaSayisi }}</p>
        </div>

        <!-- Kiralık Fabrika Sayısı -->
        <div class="p-4 text-white bg-green-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Kiralık Fabrika Sayısı</h3>
            <p class="text-2xl">{{ $kiralikFabrikaSayisi }}</p>
        </div>

        <!-- Satılık Arsa Sayısı -->
        <div class="p-4 text-white bg-purple-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Satılık Arsa Sayısı</h3>
            <p class="text-2xl">{{ $satilikArsaSayisi }}</p>
        </div>

        <!-- İlçe: Gebze Portföy Sayısı -->
        <div class="p-4 text-white bg-indigo-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Gebze Portföy Sayısı</h3>
            <p class="text-2xl">{{ $gebzeSayisi }}</p>
        </div>

        <!-- İlçe: Dilovası Portföy Sayısı -->
        <div class="p-4 text-white bg-teal-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Dilovası Portföy Sayısı</h3>
            <p class="text-2xl">{{ $dilovasiSayisi }}</p>
        </div>

        <!-- İlçe: Tuzla Portföy Sayısı -->
        <div class="p-4 text-white bg-red-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Tuzla Portföy Sayısı</h3>
            <p class="text-2xl">{{ $tuzlaSayisi }}</p>
        </div>

        <!-- Satılık Fabrikaların Toplam Değeri -->
        <div class="p-4 text-white bg-orange-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Satılık Fabrika Toplam Değeri</h3>
            <p class="text-2xl">{{ number_format($toplamSatilikFabrikaDegeri, 2) }} TL</p>
        </div>

        <!-- Kiralık Fabrikaların Toplam Değeri -->
        <div class="p-4 text-white bg-yellow-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Kiralık Fabrika Toplam Değeri</h3>
            <p class="text-2xl">{{ number_format($toplamKiralikFabrikaDegeri, 2) }} TL</p>
        </div>
    </div>
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
            @forelse($categories as $index => $category)
            <tr>
                <x-td>{{ $categories->firstItem() + $index }}</x-td>
                <x-td>{{ $category->id }}</x-td>
                <x-td>{{ $category->name }}</x-td>
                <x-td>
                    <button wire:click="toggleActive('{{ $category->id }}')"
                        class="text-xs {{ $category->isActive ? 'text-green-600' : 'text-red-600' }}">
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
                    <x-danger-button wire:click="forceDelete('{{ $category->id }}')" wire:loading.attr="disabled"
                        class="ml-2">
                        Kalıcı Sil
                    </x-danger-button>
                    @else
                    <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $category->id }}' })"
                        wire:loading.attr="disabled">
                        Düzenle
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $category->id }}' })"
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
        {{ $categories->links() }}
    </div>


</div>
