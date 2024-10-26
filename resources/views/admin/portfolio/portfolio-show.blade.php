<div class="p-4 space-y-6 bg-white rounded-lg shadow-md">
    <!-- Portfolio Details Header -->
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Portföy Detayları: {{ $portfolio->portfolio_no }}</h2>
        <div class="mt-6">
            <a wire:navigate href="{{ route('portfolios') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Geri Dön</a>
        </div>
    </div>

    <!-- Portfolio Information -->

    <div class="grid grid-cols-1 gap-4 p-6 bg-white rounded-lg shadow-md md:grid-cols-3">
        <!-- Column 1: General Portfolio Information -->
        <div class="space-y-4">
            <h3 class="text-xl font-bold text-gray-800">Genel Bilgiler</h3>
            <div>
                <span class="text-lg font-bold uppercase">{{ optional($portfolio->city)->name }} - {{ optional($portfolio->district)->name }}</span>
            </div>
            <div>
                <span class="text-lg font-bold uppercase">{{ $portfolio->lot }} ADA - {{ $portfolio->parcel }} PARSEL</span>
            </div>
            <div>
                <span class="text-lg font-bold uppercase">{{ number_format($portfolio->area_m2 ,0,',','.')}} m²</span>
            </div>
            <div>
                <span class="text-lg font-bold uppercase">{{ $portfolio->status }} {{ $portfolio->type->name }}</span>
            </div>
            <div>
                <span class="text-lg font-bold uppercase">{{ number_format($portfolio->price, 0,',', '.') }} ₺</span>
            </div>
        </div>

        <!-- Column 2 and 3: Business-Specific Information (Only visible if category is 'İşyeri') -->
        @if($portfolio->category->name === 'İşyeri')
            <!-- Column 2 -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-gray-800">İşyeri Detayları</h3>
                <div>
                    <span class="text-lg font-bold">Kapalı Alan:</span>
                    <span class="text-lg">{{ number_format($portfolio->business->closed_area, 0, ',', '.') }} m²</span>
                </div>
                <div>
                    <span class="text-lg font-bold">Açık Alan:</span>
                    <span class="text-lg">{{ number_format($portfolio->business->open_area, 0, ',', '.') }} m²</span>
                </div>
                <div>
                    <span class="text-lg font-bold">İşletme Alanı:</span>
                    <span class="text-lg">{{ number_format($portfolio->business->business_area, 0, ',', '.') }} m²</span>
                </div>
                <div>
                    <span class="text-lg font-bold">Ofis Alanı:</span>
                    <span class="text-lg">{{ number_format($portfolio->business->office_area, 0, ',', '.') }} m²</span>
                </div>
            </div>

            <!-- Column 3 -->
            <div class="space-y-4">
                <h3 class="text-xl font-bold text-gray-800">Ek Bilgiler</h3>
                <div>
                    <span class="text-lg font-bold">Yükseklik:</span>
                    <span class="text-lg">{{ $portfolio->business->height }}cm</span>
                </div>
                <div>
                    <span class="text-lg font-bold">Kat Sayısı:</span>
                    <span class="text-lg">{{ $portfolio->business->floor_count }}</span>
                </div>
                <div>
                    <span class="text-lg font-bold">Isıtma:</span>
                    <span class="text-lg">{{ $portfolio->business->heating_type }}</span>
                </div>
                <div>
                    <span class="text-lg font-bold">Bina Durumu:</span>
                    <span class="text-lg">{{ $portfolio->business->building_condition }}</span>
                </div>
            </div>
        @endif
    </div>


   <!-- Media Gallery with Zoom on Hover -->
   <div class="space-y-6">
    <div class="flex justify-center p-4 space-x-4 border border-gray-300 rounded-md">
        <!-- Display up to 5 media images side-by-side if available -->
        @foreach ($portfolio->media->take(5) as $media)
            <div class="flex flex-col items-center w-1/5"
                 x-data="{ isHovered: false }"
                 @mouseenter="isHovered = true"
                 @mouseleave="isHovered = false">
                <p class="py-2 font-bold text-center uppercase">{{ strtoupper($media->type) }}</p>
                <img :class="{ 'scale-150': isHovered }"
                     src="{{ Storage::url($media->file_path) }}"
                     alt="Portfolio Media"
                     class="object-cover w-[200px] h-[150px] rounded-md transition-transform duration-300 transform">
            </div>
        @endforeach
    </div>
</div>
    <!-- Gallery Images (if available) -->
  <div class="py-1">
    @if($portfolio->gallery && $portfolio->gallery->isNotEmpty())
    <div class="mt-8 space-y-6">
        <h3 class="font-bold text-center text-gray-700">Gallery Görselleri</h3>
        <div class="relative w-[800px] h-[500px] mx-auto overflow-hidden " x-data="{ galleryIndex: 0 }">
            @foreach ($portfolio->gallery as $index => $galleryImage)
                <div x-show="galleryIndex == {{ $index }}" class="absolute top-0 left-0 flex flex-col items-center justify-center w-full h-full transition-all duration-300">

                    <img src="{{ Storage::url($galleryImage->file_path) }}" alt="Gallery Image"
                         class="object-cover w-full h-full rounded-md">
                </div>
            @endforeach
            <!-- Slideshow Controls for gallery -->
            <button @click="galleryIndex = (galleryIndex - 1 + {{ $portfolio->gallery->count() }}) % {{ $portfolio->gallery->count() }}"
                    class="absolute px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 rounded-full top-1/2 left-2">❮</button>
            <button @click="galleryIndex = (galleryIndex + 1) % {{ $portfolio->gallery->count() }}"
                    class="absolute px-4 py-2 text-white transform -translate-y-1/2 bg-gray-700 rounded-full top-1/2 right-2">❯</button>
        </div>
    </div>
@endif
  </div>

    <!-- Back Button -->
    <div class="mt-6">
        <a wire:navigate href="{{ route('portfolios') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Geri Dön</a>
    </div>
</div>
