<div>
    <!-- Medya Ekle Modalı -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Medya Ekle
        </x-slot>

        <x-slot name="content">
            <x-form>
                <div class="grid grid-cols-2 gap-8">

                    <!-- Uydu Resmi -->
                    <div class="space-y-4 text-center" wire:key="satellite_image_section">
                        <x-label>Uydu Resmi</x-label>
                        <div x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            @if ($satellite_image)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $satellite_image->temporaryUrl() }}"
                                     alt="Yüklenen Uydu Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @elseif ($existingSatelliteImage)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $existingSatelliteImage }}"
                                     alt="Uydu Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @else
                                <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                    <span>Resim Yok</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 space-x-2">
                            <label class="inline-block px-3 py-1.5 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="satellite_image" class="hidden">
                            </label>
                            @if ($existingSatelliteImage)
                                <x-danger-button wire:click="deleteImage('uydu')">Sil</x-danger-button>
                            @endif
                        </div>
                    </div>

                    <!-- Nitelik Resmi -->
                    <div class="space-y-4 text-center" wire:key="feature_image_section">
                        <x-label>Nitelik Resmi</x-label>
                        <div x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            @if ($feature_image)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $feature_image->temporaryUrl() }}"
                                     alt="Yüklenen Nitelik Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @elseif ($existingFeatureImage)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $existingFeatureImage }}"
                                     alt="Nitelik Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @else
                                <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                    <span>Resim Yok</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 space-x-2">
                            <label class="inline-block px-3 py-1.5 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="feature_image" class="hidden">
                            </label>
                            @if ($existingFeatureImage)
                                <x-danger-button wire:click="deleteImage('nitelik')">Sil</x-danger-button>
                            @endif
                        </div>
                    </div>

                    <!-- E-imar Resmi -->
                    <div class="space-y-4 text-center" wire:key="e_imar_image_section">
                        <x-label>E-imar Resmi</x-label>
                        <div x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            @if ($e_imar_image)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $e_imar_image->temporaryUrl() }}"
                                     alt="Yüklenen E-imar Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @elseif ($existingEImarImage)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $existingEImarImage }}"
                                     alt="E-imar Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @else
                                <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                    <span>Resim Yok</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 space-x-2">
                            <label class="inline-block px-3 py-1.5 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="e_imar_image" class="hidden">
                            </label>
                            @if ($existingEImarImage)
                                <x-danger-button wire:click="deleteImage('eimar')">Sil</x-danger-button>
                            @endif
                        </div>
                    </div>

                    <!-- Büyükşehir Resmi -->
                    <div class="space-y-4 text-center" wire:key="city_image_section">
                        <x-label>Büyükşehir Resmi</x-label>
                        <div x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            @if ($city_image)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $city_image->temporaryUrl() }}"
                                     alt="Yüklenen Büyükşehir Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @elseif ($existingCityImage)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $existingCityImage }}"
                                     alt="Büyükşehir Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @else
                                <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                    <span>Resim Yok</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 space-x-2">
                            <label class="inline-block px-3 py-1.5 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="city_image" class="hidden">
                            </label>
                            @if ($existingCityImage)
                                <x-danger-button wire:click="deleteImage('buyuksehir')">Sil</x-danger-button>
                            @endif
                        </div>
                    </div>

                    <!-- Eğim Resmi -->
                    <div class="space-y-4 text-center" wire:key="slope_image_section">
                        <x-label>Eğim Resmi</x-label>
                        <div x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                            @if ($slope_image)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $slope_image->temporaryUrl() }}"
                                     alt="Yüklenen Eğim Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @elseif ($existingSlopeImage)
                                <img :class="{ 'transform scale-150': isHovered }"
                                     src="{{ $existingSlopeImage }}"
                                     alt="Eğim Resmi"
                                     class="object-cover w-56 h-32 transition-transform duration-300 rounded-lg shadow-md">
                            @else
                                <div class="flex items-center justify-center w-48 h-32 text-gray-500 bg-gray-100 rounded-lg shadow-md">
                                    <span>Resim Yok</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 space-x-2">
                            <label class="inline-block px-3 py-1.5 text-white bg-blue-500 rounded-lg cursor-pointer hover:bg-blue-600">
                                Dosya Seç
                                <input type="file" wire:model="slope_image" class="hidden">
                            </label>
                            @if ($existingSlopeImage)
                                <x-danger-button wire:click="deleteImage('eğim')">Sil</x-danger-button>
                            @endif
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
