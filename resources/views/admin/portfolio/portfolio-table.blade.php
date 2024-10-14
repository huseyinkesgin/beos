<div>
    <div class="flex items-center justify-between mb-4 space-x-4">
        <!-- Ara -->
        <x-input type="text" placeholder="Ara..." wire:model.live="search" />
<!-- Aktif/Pasif Seçimi -->
<x-select wire:model.live="isActiveFilter" class="w-full">
    <option value="">Aktif / Pasif</option>
    <option value="1">Aktif</option>
    <option value="0">Pasif</option>
</x-select>
        <!-- Durum Seçimi -->
    <x-select wire:model.live="statusFilter" class="w-full">
        <option value="">Tüm Durumlar</option>
        <option value="Satılık">Satılık</option>
        <option value="Kiralık">Kiralık</option>
        <!-- Ek durumlar varsa buraya ekleyebilirsiniz -->
    </x-select>
        <!-- Kategori Seçimi -->
        <x-select wire:model.live="categoryFilter" class="w-full">
            <option value="">Tüm Kategoriler</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>

        <!-- İl Seçimi -->
        <x-select wire:model.live="stateFilter" class="w-full">
            <option value="">Tüm İller</option>
            @foreach($states as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </x-select>

        <!-- İlçe Seçimi -->
        <x-select wire:model.live="cityFilter" class="w-full" :disabled="!$stateFilter">
            <option value="">Tüm İlçeler</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </x-select>

        <!-- Bölge Seçimi -->
        <x-select wire:model.live="districtFilter" class="w-full" :disabled="!$cityFilter">
            <option value="">Tüm Bölgeler</option>
            @foreach($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
            @endforeach
        </x-select>
    </div>

    <x-table>
        <thead>
            <tr>
                <x-th>Portföy No</x-th>
                <x-th>Tip</x-th>
                <x-th>Fiyat</x-th>
                @if ($categoryFilter == $businessCategoryId)
                <x-th>Alanlar</x-th>
            @endif
                <x-th>Durum</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                    <x-td>{{ $portfolio->portfolio_no }}
                        <br>
                        {{ $portfolio->status }}          {{ ucfirst(optional($portfolio->type)->name) }}
                        <br>
                        {{ $portfolio->owner->name }}

                    </x-td>

                    <x-td>
                        <br> {{ $portfolio->state->name }} > {{ $portfolio->city->name }} > {{  $portfolio->district->name }}
                        <br>  <span class="font-extrabold text-red-500">{{ number_format($portfolio->area_m2, 0) }} m²</span> ({{ $portfolio->lot }} / {{  $portfolio->parcel }})

                    </x-td>
                    <x-td>{{ number_format($portfolio->price, 0) }} ₺</x-td>
                    @if ($categoryFilter == $businessCategoryId)
                    <x-td>
                        Açık Alan: {{ $portfolio->business->open_area ?? "Boş " }} m² <br>
                        Kapalı Alan: {{ $portfolio->business->closed_area ?? "Boş" }} m²  <br>
                        İşletme Alanı: {{ $portfolio->business->business_area ?? "Boş "}} m² <br>
                        Ofis Alanı: {{ $portfolio->business->office_area ?? "Boş" }} m²
                    </x-td>
                @endif
                <x-td>
                    <button wire:click="toggleActive('{{ $portfolio->id }}')"
                        class="text-xs {{ $portfolio->isActive ? 'text-green-600' : 'text-red-600' }}">
                        {{ $portfolio->isActive ? 'Aktif' : 'Pasif' }}
                    </button>
                </x-td>
                    <x-td>
                        <x-button wire:click="$emit('openEditModal', {{ $portfolio->id }})">Düzenle</x-button>
                        <x-button wire:click="$emit('openDeleteModal', {{ $portfolio->id }})">Sil</x-button>
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table>

    {{ $portfolios->links() }}
</div>
