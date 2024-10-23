<div class="flex flex-row mx-4 space-x-2">
    <!-- İl Seçimi -->
    <x-select-boxo label="İl Seç" model="state_id" :options="$states" />

    <!-- İlçe Seçimi -->
    @if (!empty($cities))
    <x-select-boxo label="İlçe Seç" model="city_id" :options="$cities" />
    @endif

    <!-- Bölge Seçimi -->
    @if (!empty($districts))
    <x-select-boxo label="Bölge Seç" model="district_id" :options="$districts" />
    @endif
</div>

<div class="flex flex-row mx-4 space-x-2">

    <x-select-box label="Durum" model="status" :options="['Kiralık','Satılık']" />

    <x-select-boxo label="Kategori Seç" model="category_id" :options="$categories" />

    <!-- Type Selection -->
    @if (!empty($types))
    <x-select-boxo label="Emlak Tipi Seç" model="type_id" :options="$types" />
    @endif
</div>
