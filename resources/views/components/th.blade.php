

@props(['disabled' => false])

<th scope="col" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-3 py-3 cursor-pointer border text-center']) !!}>
{{ $slot }}
</th>





