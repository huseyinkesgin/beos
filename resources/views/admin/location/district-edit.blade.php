 {{-- resources/views/livewire/location/city-edit.blade.php --}}
 <x-dialog-modal wire:model="open" maxWidth="sm">
    <x-slot name="title">
       <span class="text-black uppercase">  {{ $name }} DÜZENLEME FORMU</span>
    </x-slot>

    <x-slot name="content">
        <x-form>

              <!-- state_id -->
              <x-select-boxo label="İl Seç" model="state_id" :options="$states" />

              <!-- city_id -->
            <x-select-boxs  label="İlçe Seç" model="city_id" :options="$cities" :selected="$city_id"/>

              <!-- name -->
              <x-input-text label="Mahalle Adı" model="name" />

               <!-- isActive -->
               <x-select-active />

        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-modal-footer />
    </x-slot>
</x-dialog-modal>


