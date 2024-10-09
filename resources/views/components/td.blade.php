@props(['disabled' => false])

<td {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-4 py-2 border text-xs']) !!}>
{{ $slot }}
</td>
