@props(['disabled' => false])

<td {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-3.5 py-2.5 text-xs border-b border-slate-200']) !!}>
{{ $slot }}
</td>
