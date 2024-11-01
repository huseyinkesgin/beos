<!-- resources/views/admin/location/personnel-cards.blade.php -->
<div>
    <div class="flex items-center justify-between mx-5">
        <div class="flex space-x-4">
            <x-paginate />
            <x-filter-isactive />
            <x-filter-trashed />
        </div>
        <x-search />
    </div>

    <!-- Cards Container -->
    <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse($personnels as $personnel)
            <div class="p-4 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center">
                    <!-- Name and Job Title -->
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                        {{ $personnel->first_name }} {{ $personnel->last_name }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $personnel->job_title }}
                    </p>
                </div>

                <!-- Status -->
                <div class="mt-2 text-center">
                    <span class="text-xs {{ $personnel->isActive ? 'text-green-500' : 'text-red-500' }}">
                        {{ $personnel->isActive ? 'Aktif' : 'Pasif' }}
                    </span>
                    <button wire:click="toggleActive('{{ $personnel->id }}')" class="text-xs ml-2">
                        <i class="fas fa-toggle-{{ $personnel->isActive ? 'on text-green-500' : 'off text-red-500' }}"></i>
                    </button>
                </div>

                <!-- Contact Information -->
                <div class="mt-4 text-center">
                    <p class="flex items-center justify-center text-gray-600 dark:text-gray-300">
                        <i class="fas fa-phone-alt mr-2 text-blue-500"></i> {{ $personnel->phone }}
                    </p>
                    <p class="flex items-center justify-center text-gray-600 dark:text-gray-300">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i> {{ $personnel->email }}
                    </p>
                </div>

                <!-- Dates Section -->
                <div class="mt-4 text-center text-gray-600 dark:text-gray-300">
                    <p>Başlama Tarihi: {{ $personnel->hire_date_for_humans }}</p>
                    @if ($personnel->deleted_at)
                        <p class="text-red-500">Silindi: {{ $personnel->deleted_at }}</p>
                    @endif
                </div>

                <!-- Actions with Icons -->
                <div class="flex items-center mt-4 space-x-4 justify-center text-gray-500">
                    @if ($deletedFilter === 'only')
                        <button wire:click="restore('{{ $personnel->id }}')" wire:loading.attr="disabled">
                            <i class="fas fa-undo text-blue-500"></i>
                        </button>
                        <button wire:click="forceDelete('{{ $personnel->id }}')" wire:loading.attr="disabled">
                            <i class="fas fa-trash-alt text-red-500"></i>
                        </button>
                    @else
                        <button wire:click="$dispatch('openEditModal', { id: '{{ $personnel->id }}' })"
                            wire:loading.attr="disabled">
                            <i class="fas fa-edit text-yellow-500"></i>
                        </button>
                        <button wire:click="$dispatch('openDeleteModal', { id: '{{ $personnel->id }}' })"
                            wire:loading.attr="disabled">
                            <i class="fas fa-trash-alt text-red-500"></i>
                        </button>
                        <button wire:click="showDetails({{ $personnel->id }})">
                            <i class="fas fa-info-circle text-blue-500"></i>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center">
                <p class="font-semibold text-red-500">Üzgünüm, herhangi bir veri bulunamadı.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="m-3">
        {{ $personnels->links() }}
    </div>
</div>
