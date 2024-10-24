<div>

        <!-- Widgetlar -->
    <div class="grid grid-cols-6 gap-4 p-4 mb-5">
        <!-- Toplam Satılık Portföy Sayısı -->
        <div class="p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold"> Satılık Arsa</h3>
            <p class="text-2xl">{{ $totalSatilikArsa }}</p>
        </div>
         <!-- Toplam Satılık Portföy Sayısı -->
         <div class="p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold"> Satılık Fabrika</h3>
            <p class="text-2xl">{{ $totalSatilikFabrika }}</p>
        </div>
         <!-- Toplam Satılık Portföy Sayısı -->
         <div class="p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Toplam Satılık Portföy</h3>
            <p class="text-2xl">{{ $totalSatilik }}</p>
        </div>

        <!-- Toplam Kiralık Portföy Sayısı -->
        <div class="p-4 text-white bg-green-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Toplam Kiralık Portföy</h3>
            <p class="text-2xl">{{ $totalKiralik }}</p>
        </div>

        <!-- Aktif Portföy Sayısı -->
        <div class="p-4 text-white bg-yellow-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Aktif Portföyler</h3>
            <p class="text-2xl">{{ $totalAktif }}</p>
        </div>

        <!-- Pasif Portföy Sayısı -->
        <div class="p-4 text-white bg-red-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Pasif Portföyler</h3>
            <p class="text-2xl">{{ $totalPasif }}</p>
        </div>

        <!-- Toplam Satılık Portföy Değeri -->
        <div class="p-4 text-white bg-purple-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Arsa Satılık Değeri</h3>
            <p class="text-2xl">{{ number_format($totalSatilikArsaDegeri, 0) }} ₺</p>
        </div>

        <!-- Toplam Kiralık Portföy Kira Değeri -->
        <div class="p-4 text-white bg-indigo-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Toplam Kira Değeri</h3>
            <p class="text-2xl">{{ number_format($totalKiraDegeri, 0) }} ₺</p>
        </div>
        <!-- Toplam Satılık Portföy Değeri -->
        <div class="p-4 text-white bg-purple-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Fabrika Satılık Değeri</h3>
            <p class="text-2xl">{{ number_format($totalSatilikFabrikaDegeri, 0) }} ₺</p>
        </div>

        <!-- Toplam Kiralık Portföy Kira Değeri -->
        <div class="p-4 text-white bg-indigo-500 rounded-lg shadow-md">
            <h3 class="text-xl font-bold">Depo Satılık Değeri</h3>
            <p class="text-2xl">{{ number_format($totalSatilikDepoDegeri, 0) }} ₺</p>
        </div>
    </div>
    <div class="flex items-center justify-between mx-5">
        <div class="flex space-x-4">
        <x-paginate />
        <x-filter-isactive />
        <x-filter-trashed />

    <x-select wire:model.live="statusFilter" class="min-w-32">
        <option value="">Tüm Durumlar</option>
        <option value="Satılık">Satılık</option>
        <option value="Kiralık">Kiralık</option>
        <!-- Ek durumlar varsa buraya ekleyebilirsiniz -->
    </x-select>
        <!-- Kategori Seçimi -->
        <x-select wire:model.live="categoryFilter" class="min-w-36">
            <option value="">Tüm Kategoriler</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>

        <!-- İl Seçimi -->
        <x-select wire:model.live="stateFilter" class="min-w-32">
            <option value="">Tüm İller</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </x-select>

        <!-- İlçe Seçimi -->
        <x-select wire:model.live="cityFilter" class="min-w-32" :disabled="!$stateFilter">
            <option value="">Tüm İlçeler</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </x-select>

        <!-- Bölge Seçimi -->
        <x-select wire:model.live="districtFilter" class="min-w-32" :disabled="!$cityFilter">
            <option value="">Tüm Bölgeler</option>
            @foreach($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
            @endforeach
        </x-select>
    </div>
    <x-search />
    <div class="flex justify-end mb-4">
        <button wire:click="export" class="px-4 py-2 text-white bg-green-500 rounded">Excel'e Aktar</button>
    </div>
    </div>

    <x-table>
        <thead>
            <tr>
                <x-th>Portföy No</x-th>
                <x-th>Kategori/Tip</x-th>
                <x-th>Lokasyon</x-th>
                <x-th class="text-center">Fiyat</x-th>
                @if ($categoryFilter == $businessCategoryId)
                <x-th>Alanlar</x-th>
            @endif
                <x-th class="text-center">Mal Sahibi/Partner</x-th>
                <x-th>Durum</x-th>
                <x-th class="text-center">İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                    <x-td>{{ $portfolio->portfolio_no }}


                    </x-td>
                    <x-td>
                        {{ $portfolio->status }}          {{ ucfirst(optional($portfolio->type)->name) }}
                        <br>
                        @if ($portfolio->category_id == $landCategoryId)  <!-- Kategori 'Arsa' ise zoning_status'u göster -->
                        ({{ $portfolio->land->zoning_status }})
                    @endif
                    </x-td>

                    <x-td>
                        <br> {{ $portfolio->state->name }} > {{ $portfolio->city->name }} > {{  $portfolio->district->name }}
                        <br> ({{ $portfolio->lot }} / {{  $portfolio->parcel }})

                    </x-td>
                    <x-td class="text-center">
                        <span class="font-bold text-black text-md">
                        {{ number_format($portfolio->price, 0) }} ₺
                    </span>
                        <br>
                        <span class="font-extrabold text-red-500">{{ number_format($portfolio->area_m2, 0) }} m²</span>
                    </x-td>
                    @if ($categoryFilter == $businessCategoryId)
                    <x-td>
                        Açık Alan: {{ $portfolio->business->open_area ?? "Boş " }} m² <br>
                        Kapalı Alan: {{ $portfolio->business->closed_area ?? "Boş" }} m²  <br>
                        İşletme Alanı: {{ $portfolio->business->business_area ?? "Boş "}} m² <br>
                        Ofis Alanı: {{ $portfolio->business->office_area ?? "Boş" }} m²
                    </x-td>
                @endif
                <x-td class="text-center">
                    @if($portfolio->owner)
                    {{ $portfolio->owner->name }}
                    @endif
                    <br>
                      @if  ($portfolio->partner)
                     <span class="text-red-600">{{ $portfolio->partner->name }}</span>
                     @endif
                </x-td>
                <x-td>
                    <button wire:click="toggleActive('{{ $portfolio->id }}')"
                        class="text-xs {{ $portfolio->isActive ? 'text-green-600' : 'text-red-600' }}">
                        {{ $portfolio->isActive ? 'Aktif' : 'Pasif' }}
                    </button>
                </x-td>
                    <x-td>
                        <x-button wire:click="$dispatch('openEditModal', {{ $portfolio->id }})">Düzenle</x-button>
                        <x-danger-button wire:click="$dispatch('openDeleteModal', { id: '{{ $portfolio->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            Sil
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openMediaModal', { id: '{{ $portfolio->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            Diğer
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openGalleryModal', { id: '{{ $portfolio->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            Galeri
                        </x-danger-button>
                        <x-danger-button wire:click="$dispatch('openAdsModal', { id: '{{ $portfolio->id }}' })"
                            wire:loading.attr="disabled" class="ml-2">
                            İlan
                        </x-danger-button>

                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table>

    {{ $portfolios->links() }}
</div>
