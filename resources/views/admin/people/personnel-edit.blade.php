<!-- resources/views/livewire/people/customer-edit.blade.php -->


<div>
    <!-- Modal -->
    <x-dialog-modal wire:model="open">
     <x-slot name="title">
        Personel Düzenle
     </x-slot>



     <x-slot name="content">
         <x-form>
            <div class="flex flex-row py-3 space-x-3">
                <!-- first_name -->
                <div class="w-full">
                    <x-label for="first_name">İsim</x-label>
                    <x-input type="text" class="w-full" wire:model.live="first_name" id="first_name"
                        placeholder="İsim" />
                    <x-input-error for="first_name" class="mt-2" />
                </div>
                <!-- last_name -->
                <div class="w-full">
                    <x-label for="last_name">Soyisim</x-label>
                    <x-input type="text" class="w-full" wire:model.live="last_name" id="last_name"
                        placeholder="Soyisim" />
                    <x-input-error for="last_name" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-row py-3 space-x-3">
                <!-- email -->
                <div class="w-full">
                    <x-label for="email">Eposta</x-label>
                    <x-input type="email" class="w-full" wire:model.live="email" id="email" />
                    <x-input-error for="email" class="mt-2" />
                </div>
                <!-- phone -->
                <div class="w-full">
                    <x-label for="phone">Telefon</x-label>
                    <x-input type="text" class="w-full" wire:model.live="phone" id="phone" />
                    <x-input-error for="phone" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-row py-3 space-x-3">
                <!-- job_title -->
                <div class="w-full">
                    <x-label for="job_title">Ünvan</x-label>
                    <x-input type="text" class="w-full" wire:model.live="job_title" id="job_title" />
                    <x-input-error for="job_title" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-row py-3 space-x-3">
                <!-- hire_date -->
                <div class="w-full">
                    <x-label for="hire_date">İşe Başlama Tarihi</x-label>
                    <x-input type="date" class="w-full" wire:model.live="hire_date" id="hire_date" />
                    <x-input-error for="hire_date" class="mt-2" />
                </div>
                <!-- termination_date -->
                <div class="w-full">
                    <x-label for="termination_date">İşten Ayrılış Tarihi</x-label>
                    <x-input type="date" class="w-full" wire:model.live="termination_date" id="termination_date" />
                    <x-input-error for="termination_date" class="mt-2" />
                </div>
            </div>

            <!-- Active Status -->
            <div class="my-4">
                <x-label for="isActive">Aktif Mi?</x-label>
                <x-checkbox wire:model.live="isActive" id="isActive" />
            </div>

         </x-form>
     </x-slot>

     <x-slot name="footer">
         <div>
             <x-secondary-button wire:click="$toggle('open')" wire:loading.attr="disabled">
                 Vazgeç
             </x-secondary-button>
             <x-button wire:click="save">Kaydet</x-button>
         </div>
     </x-slot>
 </x-dialog-modal>
 </div>

