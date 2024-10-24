<div>
    @if ($showSlideshow)
    <!-- Modal Görüntüleme -->
    <x-dialog-modal wire:model="showSlideshow">
        <x-slot name="title">
            Resim Galerisi
        </x-slot>

        <x-slot name="content">
            <div class="relative">
                <!-- Büyük Resim Gösterimi -->
                <img src="{{ $galleryImages[$currentImageIndex]['url'] }}" alt="Büyük Resim" class="object-cover w-full h-full max-w-screen-md">

                <!-- Önceki ve Sonraki Butonlar -->
                <button wire:click="previousImage" class="absolute left-0 p-2 text-white transform -translate-y-1/2 bg-black bg-opacity-50 top-1/2">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button wire:click="nextImage" class="absolute right-0 p-2 text-white transform -translate-y-1/2 bg-black bg-opacity-50 top-1/2">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showSlideshow')">Kapat</x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    @endif
</div>
