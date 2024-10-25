<div>
    <!-- Galeri Modalı -->
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            Galeri Yönetimi
        </x-slot>

        <x-slot name="content">
            <!-- Mevcut Resimler -->
            <div id="sortable-gallery" class="grid grid-cols-4 gap-4">
                @foreach ($galleryImages as $index => $image)
                    <div class="relative group" data-id="{{ $image['id'] }}" wire:key="gallery-image-{{ $image['id'] }}">
                        <!-- Resim Önizleme -->
                        <div class="overflow-hidden rounded-md shadow-md">
                            <img src="{{ $image['url'] }}" alt="Galeri Resmi"
                                 class="object-cover w-32 h-32 transition-transform duration-300 transform group-hover:scale-150">
                        </div>

                        <!-- Silme Butonu -->
                        <button wire:click="removeImage({{ $image['id'] }})"
                                class="absolute p-1 text-white transition duration-300 bg-red-600 rounded-full opacity-0 top-2 right-2 group-hover:opacity-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Yeni Resimler Ekleme -->
            <div class="mt-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Yeni Resimler Yükle</label>
                <input type="file" wire:model="newImages" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">

                @if ($newImages)
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        @foreach ($newImages as $index => $image)
                            <div class="relative group">
                                <!-- Yeni Yüklenen Resim Önizleme -->
                                <img src="{{ $image->temporaryUrl() }}" alt="Yüklenen Resim" class="object-cover w-32 h-32 transition duration-300 ease-in-out transform rounded-md shadow-md hover:scale-105">

                                <!-- Yüklenmekte Olan Resmi Kaldırma Butonu -->
                                <button wire:click="removeNewImage({{ $index }})" class="absolute p-1 text-white transition duration-300 bg-red-600 rounded-full opacity-0 top-2 right-2 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Yükleme İlerlemesi -->
            <div class="mt-6">
                <div wire:loading wire:target="newImages">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $uploadProgress }}%"></div>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">{{ $uploadProgress }}% Yükleniyor...</p>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex justify-between items-center w-full">
                <!-- Sol tarafa yerleşen buton -->
                <div class="flex pl-3">
                    <i wire:click="$dispatch('openSlideShowModal', { id: '{{ $portfolioId }}' })"
                       class="text-lg text-blue-500 cursor-pointer fa-solid fa-sliders font-2xl"></i>
                </div>

                <!-- Sağ tarafa yerleşen modal footer butonları -->
                <div>
                    <x-modal-footer />
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
    <livewire:portfolio.portfolio-slide-show :portfolioId="$portfolioId" />

    <!-- Sortable.js ve Livewire ile entegre ediyoruz -->
    <script>
        document.addEventListener('livewire:load', function () {
            var el = document.getElementById('sortable-gallery');
            var sortable = new Sortable(el, {
                animation: 150,
                ghostClass: 'sortable-drag',
                onEnd: function (evt) {
                    let orderedIds = Array.from(el.children).map(item => item.getAttribute('data-id'));
                    Livewire.dispatch('updateImageOrder', orderedIds);
                }
            });
        });
    </script>
</div>
