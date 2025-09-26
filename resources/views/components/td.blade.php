@props(['disabled' => false])

<td {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'px-3.5 py-1.5 text-xs border-b border-amber-400 border-dashed text-amber-900'
]) !!}>
    {{ $slot }}
</td>
