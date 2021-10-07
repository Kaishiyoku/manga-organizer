@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => classNames('block font-medium text-sm text-gray-700 dark:text-gray-500', ['label-required' => $required])]) }}>
    {{ $value ?? $slot }}
</label>
