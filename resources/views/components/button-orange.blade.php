<button {{ $attributes->merge(['type' => 'button', 'class' => 
'inline-flex items-center px-1 py-1 bg-orange-700  border border-orange-300 font-semibold text-xs text-white  tracking-widest shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2  disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
