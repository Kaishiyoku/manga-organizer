<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center space-x-2 px-4 py-2 bg-purple-500 dark:bg-purple-600 border border-transparent rounded-md font-semibold shadow text-xs text-white uppercase tracking-widest hover:bg-purple-700 dark:hover:bg-purple-500 active:bg-gray-900 dark:active:bg-purple-800 focus:outline-none focus:border-gray-900 focus:ring focus:ring-purple-300/75 dark:focus:ring-purple-400/75 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
