<button
    {{ $attributes->merge(['type' => 'button', 
    'class' => 'inline-flex items-center px-1 py-1 bg-white  border border-amber-500 font-bold text-xs text-amber-900 tracking-widest shadow-sm hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
