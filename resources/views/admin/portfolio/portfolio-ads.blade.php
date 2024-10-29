<div>
    <!-- Medya Ekle Modalı -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Yeni İlan
        </x-slot>

        <x-slot name="content">
            @if (session()->has('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Daha önce eklenen ilanları göster -->
        <div class="my-4">
            <h3 class="text-lg font-semibold text-gray-700">Mevcut İlanlar</h3>
            @if ($existingAds && $existingAds->isNotEmpty())
                <ul class="mt-3 space-y-2">
                    @foreach ($existingAds as $ad)
                        <li class="flex items-center justify-between p-3 bg-gray-100 rounded-lg shadow-sm">
                            <div>
                                <p class="font-medium text-gray-700">{{ $ad->site_name }}</p>
                                <p class="text-sm text-gray-500">{{ $ad->ads_id }} -
                                    <a href="{{ $ad->ads_link }}" target="_blank" class="text-blue-500 underline hover:text-blue-700">İlan Linki</a>
                                </p>
                            </div>
                            <span class="inline-flex px-3 py-1 text-xs font-semibold text-white rounded-lg
                            @if($ad->status == 'Aktif') bg-green-500 @elseif($ad->status == 'Pasif') bg-yellow-500 @else bg-gray-500 @endif">
                                {{ $ad->status }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="p-4 mt-4 text-gray-500 bg-gray-100 rounded-lg shadow-sm">Bu portföyde henüz ilan eklenmemiş.</p>
            @endif
        </div>
            <x-form>
                <!-- Medya dosyalarının yüklenmesi için form -->
                <div class="flex flex-row space-x-3">

                    <x-select-box label="Site Adı" model="site_name" :options="['Sahibinden','Hepsiemlak','Zingat','BuradaYapi','DepoFabrika','ArsaBurada']" />

                    <!-- İlan ID -->
                   <x-input-text label="İlan No" model="ads_id" />
                </div>
                <div class="flex flex-row space-x-3">
                    <!-- İlan Linki -->
                    <x-input-text label="İlan Link" model="ads_link" />

                    <!-- Durum -->
                    <x-select-box label="Durum" model="status" :options="['Aktif','Pasif','İlan Yok']" />

                </div>
            </x-form>
        </x-slot>

        <x-slot name="footer">
           <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
