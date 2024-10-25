<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-3 py-1.5 bg-orange-700 dark:bg-orange-700 border border-orange-300 dark:border-orange-500 rounded-lg font-semibold text-sm text-white dark:text-white  tracking-widest shadow-lg hover:bg-orange-600 dark:hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 dark:focus:ring-offset-orange-700 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
