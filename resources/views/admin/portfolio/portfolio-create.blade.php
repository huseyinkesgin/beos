<div>
    <x-dark-button class="" wire:click="$dispatch('openCreateModal')">Yeni Portföy Ekle</x-dark-button>

    <x-dialog-modal wire:model.live="open">
        <x-slot name="title">
            Yeni Portföy
        </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="border rounded-lg shadow-lg bg-slate-50">
                    <div class="flex flex-row mx-4 space-x-2">
                        <!-- İl Seçimi -->
                        <x-select-boxo label="İl Seç" model="state_id" :options="$states" />

                        <!-- İlçe Seçimi -->
                        @if (!empty($cities))
                        <x-select-boxo label="İlçe Seç" model="city_id" :options="$cities" />
                        @endif

                        <!-- Bölge Seçimi -->
                        @if (!empty($districts))
                        <x-select-boxo label="İlçe Seç" model="district" :options="$districts" />
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
                </div>

                <!-- Dinamik Form Seçimi -->
                @if ($form_path)
                    @include($form_path)
                @endif
            </x-form>
        </x-slot>

        <x-slot name="footer">
            <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
