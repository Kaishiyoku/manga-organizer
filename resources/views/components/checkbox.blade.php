@props(['checked' => false])

<input
    type="checkbox"
    @checked($checked)
    {{ $attributes->merge(['class' => 'rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200/50']) }}
/>
