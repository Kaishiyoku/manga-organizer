@props(['active' => false])

<a {{ $attributes->merge(['class' => classNames('block px-4 py-2 text-sm leading-5 text-gray-700 focus:outline-none transition duration-150 ease-in-out', ['text-white bg-purple-400 dark:bg-purple-800 hover:bg-purple-500 dark:hover:bg-purple-700 focus:bg-purple-500' => $active, 'dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-600 dark:focus:text-gray-300' => !$active])]) }}>
    {{ $slot }}
</a>
