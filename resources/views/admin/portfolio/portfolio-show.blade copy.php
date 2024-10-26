<div class="p-4 space-y-6 text-center bg-white rounded-lg shadow-md">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold">Portföy Detayları: {{ $portfolio->portfolio_no }}</h2>
        <div class="mt-6">
            <a wire:navigate href="{{ route('portfolios') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Geri
                Dön</a>
        </div>
    </div>
   <div class="border border-black rounded-md m-96">
    <div class="flex justify-center py-12">
        <img src="{{ asset('banner.png') }}" alt="">
    </div>

    <div class="pt-12 pb-3">
        <span class="text-4xl font-bold uppercase">{{ optional($portfolio->city)->name }} - {{
            optional($portfolio->district)->name }}</span>
    </div>

    <div class="py-3">
        <span class="text-4xl font-bold uppercase">{{ $portfolio->lot }} ADA - {{ $portfolio->parcel }} PARSEL</span>
    </div>
    <div class="py-3">
        <span class="text-4xl font-bold uppercase">{{ number_format($portfolio->area_m2 ,0,',','.')}} m²</span>
    </div>

    <div class="py-3">
        <span class="text-4xl font-bold uppercase">{{ $portfolio->status }} {{ $portfolio->type->name }} </span>
    </div>
    <div class="py-3">
        <span class="text-4xl font-bold uppercase"> {{ number_format($portfolio->price, 0,',', '.') }} ₺</span>
    </div>
    <div class="py-24">

    </div>
   </div>


    {{-- <!-- Medya Görselleri -->
    <div class="space-y-6">
        @foreach ($portfolio->media as $media)
        <div class="">
            <p class="py-2 font-bold text-center uppercase">
                {{ strtoupper($media->type) }}
            </p>
            <img src="{{ Storage::url($media->file_path) }}" alt="Portfolio Media"
                class="object-cover w-[800px] h-[500px] mx-auto rounded-md">
        </div>
        @endforeach
    </div> --}}
    <div class="space-y-8">
        <!-- İlk Çift Resim (A4 İçin) -->
        @if(isset($portfolio->media[0]) || isset($portfolio->media[1]))
            <div class="flex flex-col items-center p-1 border border-black rounded-lg mx-96" >
                <!-- Üst Boşluk -->

                <!-- İlk Resim -->
                @if(isset($portfolio->media[0]))
                    <div class="flex flex-col items-center mb-8">
                        <p class="py-2 font-bold text-center uppercase">
                            {{ strtoupper($portfolio->media[0]->type) }}
                        </p>
                        <img src="{{ Storage::url($portfolio->media[0]->file_path) }}" alt="Portfolio Media"
                             class="object-cover w-[794px] h-[500px] rounded-md border border-gray-300 shadow-lg">
                    </div>
                @endif
                <!-- İkinci Resim -->
                @if(isset($portfolio->media[1]))
                    <div class="flex flex-col items-center">
                        <p class="py-2 font-bold text-center uppercase">
                            {{ strtoupper($portfolio->media[1]->type) }}
                        </p>
                        <img src="{{ Storage::url($portfolio->media[1]->file_path) }}" alt="Portfolio Media"
                             class="object-cover w-[794px] h-[500px] rounded-md border border-gray-300 shadow-lg">
                    </div>
                @endif
                <!-- Alt Boşluk -->
                <div class="flex justify-between w-full pt-8">
                    <div></div>
                </div>
            </div>
        @endif

        <!-- İkinci Çift Resim (A4 İçin) -->
        @if(isset($portfolio->media[2]) || isset($portfolio->media[3]))
        <div class="flex flex-col items-center p-1 border border-black rounded-lg mx-96" >

                <!-- Üçüncü Resim -->
                @if(isset($portfolio->media[2]))
                    <div class="flex flex-col items-center mb-8">
                        <p class="py-2 font-bold text-center uppercase">
                            {{ strtoupper($portfolio->media[2]->type) }}
                        </p>
                        <img src="{{ Storage::url($portfolio->media[2]->file_path) }}" alt="Portfolio Media"
                             class="object-cover w-[794px] h-[500px] rounded-md border border-gray-300 shadow-lg">
                    </div>
                @endif
                <!-- Dördüncü Resim -->
                @if(isset($portfolio->media[3]))
                    <div class="flex flex-col items-center">
                        <p class="py-2 font-bold text-center uppercase">
                            {{ strtoupper($portfolio->media[3]->type) }}
                        </p>
                        <img src="{{ Storage::url($portfolio->media[3]->file_path) }}" alt="Portfolio Media"
                             class="object-cover w-[794px] h-[500px] rounded-md border border-gray-300 shadow-lg">
                    </div>
                @endif
                <!-- Alt Boşluk -->
                <div class="flex justify-between w-full pt-8">
                    <div></div>
                </div>
            </div>
        @endif

        <!-- Tek Resim (5. Resim, A4 İçin) -->
        @if(isset($portfolio->media[4]))
            <div class="flex flex-col items-center p-8 border border-black rounded-lg" style="height: 100vh;">
                <!-- Üst Boşluk -->
                <div class="flex justify-between w-full pb-8">
                    <div></div>
                </div>
                <!-- Beşinci Resim -->
                <div class="flex flex-col items-center">
                    <p class="py-2 font-bold text-center uppercase">
                        {{ strtoupper($portfolio->media[4]->type) }}
                    </p>
                    <img src="{{ Storage::url($portfolio->media[4]->file_path) }}" alt="Portfolio Media"
                         class="object-cover w-[794px] h-[500px] rounded-md border border-gray-300 shadow-lg">
                </div>
                <!-- Alt Boşluk -->
                <div class="flex justify-between w-full pt-8">
                    <div></div>
                </div>
            </div>
        @endif
    </div>



   <!-- Gallery Görselleri (Varsa) -->
@if($portfolio->gallery && $portfolio->gallery->isNotEmpty())
<div class="mt-8 space-y-6">
    <h3 class="mb-4 font-bold text-center text-gray-700">Gallery Görselleri</h3>
    @foreach ($portfolio->gallery as $galleryImage)
        <div class="text-center">
            <p class="py-2 font-bold text-center uppercase">Resim</p>
            <img src="{{ Storage::url($galleryImage->file_path) }}" alt="Gallery Image" class="object-cover w-[800px] h-[600px] mx-auto rounded-md">
        </div>
    @endforeach
</div>
@endif

    <!-- Geri Git Butonu -->
    <div class="mt-6">
        <a wire:navigate href="{{ route('portfolios') }}" class="px-4 py-2 text-white bg-blue-500 rounded">Geri Dön</a>
    </div>
</div>
