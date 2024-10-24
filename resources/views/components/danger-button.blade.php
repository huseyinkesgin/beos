<button {{ $attributes->merge(['type' => 'button', 'class' => 'nline-flex items-center px-3 py-1.5 bg-white dark:bg-gray-800 border border-red-300 rounded-md font-semibold text-sm text-gray-700  tracking-widest hover:bg-red-500 hover:text-white active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
