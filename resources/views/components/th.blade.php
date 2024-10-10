

@props(['disabled' => false])

<th scope="col" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-3.5 py-2.5 uppercase font-semibold border-b border-slate-200']) !!}>
{{ $slot }}
</th>





