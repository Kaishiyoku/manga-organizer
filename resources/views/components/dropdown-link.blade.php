@props(['active' => false])

<a {{ $attributes->merge(['class' => classNames('block px-4 py-2 text-sm leading-5 text-gray-700 focus:outline-none transition duration-150 ease-in-out', ['text-white bg-purple-400 hover:bg-purple-500 focus:bg-purple-500' => $active, 'hover:bg-gray-100 focus:bg-gray-100' => !$active])]) }}>
    {{ $slot }}
</a>
