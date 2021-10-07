@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => classNames('dark:text-gray-400 dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:border-purple-300 dark:focus:border-purple-500 focus:ring focus:ring-purple-200 dark:focus:ring-purple-500 focus:ring-opacity-50 rounded-md shadow-sm transition', ['border-red-800' => $errors->has($attributes->get('name')), 'opacity-50' => $disabled])]) !!}>
