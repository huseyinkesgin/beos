@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="relative p-2 ">
        <div class="border-dashed border-2 border-amber-500 p-2">
            <!-- Kapatma Düğmesi -->
            <button type="button"
                class="absolute p-2 text-amber-800 top-2 right-2 hover:text-amber-600 dark:hover:text-gray-300"
                aria-label="Close" @click="$dispatch('close')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="text-md pb-2 font-medium text-gray-900">
                {{ $title }}
            </div>
            <div class="text-sm bg-white border-2 border-dotted border-amber-500 rounded-lg">
                {{ $content }}
            </div>


            <div class="flex flex-row justify-end px-6 py-2 text-end">
                {{ $footer }}
            </div>
        </div>
    </div>
</x-modal>
