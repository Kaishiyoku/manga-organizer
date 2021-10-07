@props(['value' => null])

<input type="checkbox" {{ $value ? 'value="1"' : '' }} {{ $attributes->merge(['class' => 'rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50']) }}>
