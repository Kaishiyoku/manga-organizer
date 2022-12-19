@props(['disabled' => false, 'readonly' => false, 'name' => null])

<input
    autocapitalize="on"
    @disabled($disabled)
    @readonly($readonly)
    {{ $attributes->merge(['name' => $name, 'class' => classNames('dark:text-gray-400 dark:bg-gray-700/50 border-gray-300 dark:border-gray-700 focus:border-purple-500 rounded-md shadow focus:shadow-md dark:shadow-black/25 focus:ring-purple-500 transition', ['border-pink-800' => $errors->has($name), 'opacity-50' => $disabled || $readonly])]) }}
/>
