<button {{ $attributes->merge(['type' => 'button', 'class' => 
'inline-flex items-center px-1 py-1 bg-white border border-red-300 rounded-md font-bold text-xs text-gray-700  tracking-widest hover:bg-red-500 hover:text-white active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
