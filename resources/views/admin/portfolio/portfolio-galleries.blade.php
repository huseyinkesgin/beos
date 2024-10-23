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
                        <img src="{{ $image['url'] }}" alt="Galeri Resmi" class="object-cover w-32 h-32 transition duration-300 ease-in-out transform rounded-md shadow-md hover:scale-105">

                        <!-- Silme Butonu -->
                        <button wire:click="removeImage({{ $image['id'] }})" class="absolute p-1 text-white transition duration-300 bg-red-600 rounded-full opacity-0 top-2 right-2 group-hover:opacity-100">
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
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('open')">Vazgeç</x-secondary-button>
            <x-button wire:click="save">Kaydet</x-button>
        </x-slot>
    </x-dialog-modal>

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
