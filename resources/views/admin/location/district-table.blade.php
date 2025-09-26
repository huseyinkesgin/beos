 {{-- resources/views/admin/location/district-table.blade.php --}}

<div>
   <x-standart />

<x-table>
         <x-thead>
             <x-th>Sıra No</x-th>
             <x-th>
                 <button wire:click="sortBy('id')" class="flex items-center font-bold">
                     ID
                     <span class="ml-1">{!! $this->getSortIcon('id') !!}</span>
                 </button>
             </x-th>
             <x-th>
                 <button wire:click="sortBy('state_id')" class="flex items-center font-bold">
                     İl
                     <span class="ml-1">{!! $this->getSortIcon('state_id') !!}</span>
                 </button>
             </x-th>
             <x-th>
                 <button wire:click="sortBy('city_id')" class="flex items-center font-bold">
                     İlçe
                     <span class="ml-1">{!! $this->getSortIcon('city_id') !!}</span>
                 </button>
             </x-th>
             <x-th>
                 <button wire:click="sortBy('name')" class="flex items-center font-bold">
                     Adı
                     <span class="ml-1">{!! $this->getSortIcon('name') !!}</span>
                 </button>
             </x-th>
             <x-th>Durum</x-th>
             <x-th>Tarihler</x-th>
             <x-th>İşlemler</x-th>

         </x-thead>
         <tbody>
             @forelse($districts as $index => $district)
                 <tr>
                     <x-td>{{ $districts->firstItem() + $index }}</x-td>
                     <x-td>{{ $district->id }}</x-td>
                     <x-td>{{ $district->state->name }} </x-td>
                     <x-td>{{ $district->city->name }} </x-td>
                     <x-td>{{ $district->name }}</x-td>
                     <x-td>
                         <button wire:click="toggleActive('{{ $district->id }}')"
                             class="text-xs {{ $district->isActive ? 'text-green-600' : 'text-red-600' }}">
                             {{ $district->isActive ? 'Aktif' : 'Pasif' }}
                         </button>
                     </x-td>
                     <x-td class="italic">
                         {{ $district->created_at }} <br>
                         {{ $district->updated_at }}
                         @if ($district->deleted_at)
                             <br><span class="text-red-600">{{ $district->deleted_at }}</span>
                         @endif

                     </x-td>
                     <x-td>
                         @if ($deletedFilter === 'only')
                             <x-secondary-button wire:click="restore('{{ $district->id }}')"
                                 wire:loading.attr="disabled">
                                 Geri Al
                             </x-secondary-button>
                             <x-danger-button wire:click="forceDelete('{{ $district->id }}')"
                                 wire:loading.attr="disabled" class="ml-2">
                                 Kalıcı Sil
                             </x-danger-button>
                         @else
                             <x-secondary-button wire:click="$dispatch('openEditModal', { id: '{{ $district->id }}' })"
                                 wire:loading.attr="disabled">
                                 Düzenle
                                 </x-danger-button>
                                 <x-danger-button
                                     wire:click="$dispatch('openDeleteModal', { id: '{{ $district->id }}' })"
                                     wire:loading.attr="disabled" class="ml-2">
                                     Sil
                                 </x-danger-button>
                         @endif
                     </x-td>
                 </tr>
             @empty
                 <tr>
                     <td colspan="6" class="py-8 text-center">
                         <p class="font-semibold text-red-500">Üzgünüm, herhangi bir veri bulunamadı.</p>
                     </td>
                 </tr>
             @endforelse
         </tbody>
     </x-table>




     <div class="m-3">
         {{ $districts->links() }}
     </div>



 </div>
