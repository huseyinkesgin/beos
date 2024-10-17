<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-3 py-1 bg-gray-800 dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-lg font-semibold text-xs text-gray-100 dark:text-gray-100  tracking-widest shadow-lg hover:bg-gray-600 dark:hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
