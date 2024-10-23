{{-- MAL SAHİBİ --}}
<div class="flex flex-row justify-between mx-4">

    <div class="flex-1 my-4">
        <x-label for="owner_customer_id">Mal Sahibi Seç</x-label>
        <x-select wire:model.live="owner_customer_id" id="owner_customer_id" class="w-full">
            <option value="">Seçiniz</option>
            <option value="">Bilinmiyor</option>
            @foreach ($ownerList as $owner)
            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
            @endforeach
        </x-select>
        <x-input-error for="owner_customer_id" class="mt-2" />

    </div>
</div>
<div class="flex flex-row justify-between mx-4">

    {{-- PARTNER VAR MI --}}
    <div class="flex-1 my-4">
        <x-label for="has_partner" class="mr-2">Partner Var Mı?</x-label>
        <x-checkbox wire:model.live="has_partner" id="has_partner" />
        <x-input-error for="has_partner" class="mt-2" />
    </div>
</div>


@if ($has_partner || $owner_customer_id == '0')
<div class="flex flex-row justify-between mx-4">
    <div class="flex-1 my-4">
        <x-label for="partner_customer_id">Partner Seç</x-label>
        <x-select wire:model.live="partner_customer_id" id="partner_customer_id" class="w-full">
            <option value="">Seçiniz</option>
            @if (!empty($partnerList))
            @foreach ($partnerList as $partner)
            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
            @endforeach
            @endif
        </x-select>
        <x-input-error for="partner_customer_id" class="mt-2" />
    </div>
</div>
@endif

<div class="flex flex-row space-x-2">
    <x-select-boxo label="Danışman Seç" model="advisor" :options="$advisorsList" />
</div>
