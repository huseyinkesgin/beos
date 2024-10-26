<x-dialog-modal wire:model="open">
    <x-slot name="title">
       Ekstra Dökümanlar (Lot: {{ $lot }}, Parsel: {{ $parcel }})
    </x-slot>

    <x-slot name="content">
        <x-form>
            <!-- Yeni Döküman Yükle -->
            <div class="mb-4 space-y-4">
                <x-input label="Belge Adı" wire:model.defer="file_name" placeholder="Belge adını giriniz" />

                <!-- Dosya Yükleme Girişi -->
                <div class="flex items-center space-x-2">
                    <x-input type="file" wire:model="file" class="w-full" />
                    <x-button wire:click="save" label="Yükle" primary class="px-4 py-2" />
                </div>

                <!-- Yükleniyor İlerleme Çubuğu -->
                <div wire:loading wire:target="file" class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full animate-pulse"></div>
                </div>
            </div>

            <!-- Mevcut Dökümanlar -->
            <div class="mt-6">
                <h3 class="mb-4 text-lg font-semibold text-gray-700">Yüklenen Dökümanlar</h3>
                <ul class="space-y-3">
                    @foreach($existingExtras as $extra)
                        <li class="flex items-center justify-between p-2 border-b border-gray-200 rounded-md bg-gray-50">
                            <!-- Dosya Adı ve İndirme Linki -->
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 01-2.828 0L3 10.828M3 21h18M3 3l18 18" />
                                </svg>
                                <span class="text-gray-700">{{ $extra->file_name }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ Storage::url($extra->file_path) }}" target="_blank" class="text-blue-500 hover:underline">İndir</a>
                                <button wire:click="deleteFile({{ $extra->id }})" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-modal-footer />
    </x-slot>
</x-dialog-modal>
