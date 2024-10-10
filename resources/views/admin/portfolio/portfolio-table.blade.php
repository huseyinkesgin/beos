{{-- resources/views/livewire/portfolio/portfolio-table.blade.php --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <x-input type="text" placeholder="Ara..." wire:model="search" />
        <x-select wire:model="typeFilter">
            <option value="">Tüm Türler</option>
            <option value="land">Arsa</option>
            <option value="home">Konut</option>
            <option value="business">İşyeri</option>
        </x-select>
        <x-select wire:model="categoryFilter">
            <option value="">Tüm Kategoriler</option>
            <option value="villa">Villa</option>
            <option value="depo">Depo</option>
            <!-- Kategorilerinizi buraya ekleyin -->
        </x-select>
    </div>
    <x-table>
        <thead>
            <tr>
                <x-th>Portföy No</x-th>
                <x-th>Tür</x-th>
                <x-th>Kategori</x-th>
                <x-th>Fiyat</x-th>
                <x-th>Durum</x-th>
                <x-th>İşlemler</x-th>
            </tr>
        </thead>
        <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                    <x-td>{{ $portfolio->portfolio_no }}</x-td>
                    <x-td>{{ ucfirst($portfolio->type) }}</x-td>
                    <x-td>{{ ucfirst($portfolio->category) }}</x-td>
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
