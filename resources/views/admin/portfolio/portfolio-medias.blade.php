<div>
    <!-- Medya Ekle Modalı -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Medya Ekle
        </x-slot>

        <x-slot name="content">
            <x-form>
                <!-- Medya dosyalarının yüklenmesi için form -->
                <div class="grid grid-cols-2 gap-8">

                    <!-- Uydu Resmi -->
                    <div class="space-y-4 text-center">
                        <x-label>Uydu Resmi</x-label>
                        @if ($satellite_image)
                            <img src="{{ $satellite_image->temporaryUrl() }}" alt="Yüklenen Uydu Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @elseif ($existingSatelliteImage)
                            <img src="{{ $existingSatelliteImage }}" alt="Uydu Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                <span>Resim Yok</span>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="satellite_image" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- Nitelik Resmi -->
                    <div class="space-y-4 text-center">
                        <x-label>Nitelik Resmi</x-label>
                        @if ($feature_image)
                            <img src="{{ $feature_image->temporaryUrl() }}" alt="Yüklenen Nitelik Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @elseif ($existingFeatureImage)
                            <img src="{{ $existingFeatureImage }}" alt="Nitelik Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                <span>Resim Yok</span>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="feature_image" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- E-imar Resmi -->
                    <div class="space-y-4 text-center">
                        <x-label>E-imar Resmi</x-label>
                        @if ($e_imar_image)
                            <img src="{{ $e_imar_image->temporaryUrl() }}" alt="Yüklenen E-imar Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @elseif ($existingEImarImage)
                            <img src="{{ $existingEImarImage }}" alt="E-imar Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                <span>Resim Yok</span>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="e_imar_image" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- Büyükşehir Resmi -->
                    <div class="space-y-4 text-center">
                        <x-label>Büyükşehir Resmi</x-label>
                        @if ($city_image)
                            <img src="{{ $city_image->temporaryUrl() }}" alt="Yüklenen Büyükşehir Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @elseif ($existingCityImage)
                            <img src="{{ $existingCityImage }}" alt="Büyükşehir Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                <span>Resim Yok</span>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="city_image" class="hidden">
                            </label>
                        </div>
                    </div>

                    <!-- Eğim Resmi -->
                    <div class="space-y-4 text-center">
                        <x-label>Eğim Resmi</x-label>
                        @if ($slope_image)
                            <img src="{{ $slope_image->temporaryUrl() }}" alt="Yüklenen Eğim Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @elseif ($existingSlopeImage)
                            <img src="{{ $existingSlopeImage }}" alt="Eğim Resmi" class="object-cover w-48 h-32 rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                <span>Resim Yok</span>
                            </div>
                        @endif
                        <div class="mt-4">
                            <label class="inline-block px-4 py-2 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="slope_image" class="hidden">
                            </label>
                        </div>
                    </div>

                </div>
            </x-form>
        </x-slot>

        <x-slot name="footer">
          <x-modal-footer />
        </x-slot>
    </x-dialog-modal>
</div>
