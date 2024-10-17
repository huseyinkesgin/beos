<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Personel Detay') }}
            </h2>

            @livewire('portfolio.type-create')
        </div>
    </x-slot>

    <div class="mx-auto">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">


            <div class="min-w-full border">
                <div class="bg-slate-100">
                    <h3 class="flex flex-row justify-between p-4">
                        <span class="text-lg text-slate-600"> Personel Bilgisi</span> <span
                            class="flex justify-end text-2xl font-black">{{ $personnel->first_name }} {{
                            $personnel->last_name }}</span>
                    </h3>
                </div>
                <div class="m-4">
                    <table>
                        <tr>
                            <td class="font-bold text-black">
                                İşe Başlama Tarihi
                            </td>
                            <td>
                                : {{ $personnel->hire_date }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold text-black">
                                Ünvan
                            </td>
                            <td>
                                : {{ $personnel->job_title }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold text-black">
                                Telefon
                            </td>
                            <td>
                                : {{ $personnel->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold text-black">
                                Eposta
                            </td>
                            <td>
                                : {{ $personnel->email }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold text-black">
                                Durum
                            </td>
                            <td>
                                : {{ $personnel->isActive ? 'Aktif' : 'Pasif' }}
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="flex flex-row justify-between m-4">
                    <span>ADRES BİLGİLERİ</span>
                    <div>
                        <x-secondary-button
                            wire:click="$dispatch('openAddressModal', { modelType: 'App\\\\Models\\\\Personnel', modelId: '{{ $personnel->id }}' })"
                            wire:loading.attr="disabled">
                            Adres Ekle
                        </x-secondary-button>
                        <livewire:shorts.address-modal />
                    </div>
                </div>
                <div class="m-4">
                    <table>
                        @if($personnel->addresses->isNotEmpty())
                        @foreach($personnel->addresses as $address)
                        <tr>
                            <td class="font-bold text-black">
                                {{ $address->address_type }}
                            </td>

                            <td>
                                : {{ $address->district->name ?? '' }} {{ $address->address_line1 }} {{
                                $address->city->name ?? '' }}, {{ $address->state->name ?? '' }}
                            </td>
                            <td>
                                <button type="button"
                                    class="px-2 py-1 mx-2 my-1 text-xs text-white bg-red-500 rounded-lg">Sil</button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>Adres bilgisi yok.</p>
                        @endif

                    </table>

                </div>

            </div>
        </div>
    </div>
