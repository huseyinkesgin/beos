@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-amber-50 border border-amber-300 text-black text-xs  focus:ring-amber-500 focus:border-amber-500 block py-1 px-2  w-full ',
]) !!}>

    {{ $slot }}
</select>
