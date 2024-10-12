<div>
    <div class="flex items-center justify-between mb-4">
        <x-input type="text" placeholder="Ara..." wire:model="search" />
        <x-select wire:model="categoryFilter" class="w-full">
            <option value="">Tüm Kategoriler</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>
    </div>

    <x-table>
        <thead>
            <tr>
                <x-th>Portföy No</x-th>
                <x-th>Kategori</x-th>
                <x-th>Tip</x-th>
                <x-th>Fiyat</x-th>
                <x-th>Durum</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                    <x-td>{{ $portfolio->portfolio_no }}</x-td>
                    <x-td>{{ ucfirst(optional($portfolio->category)->name) }}</x-td>
                    <x-td>{{ ucfirst(optional($portfolio->type)->name) }}</x-td>
                    <x-td>{{ number_format($portfolio->price, 2) }} ₺</x-td>
                    <x-td>{{ $portfolio->isActive ? 'Aktif' : 'Pasif' }}</x-td>
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
