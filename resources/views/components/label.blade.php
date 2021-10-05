@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => classNames('block font-medium text-sm text-gray-700', ['label-required' => $required])]) }}>
    {{ $value ?? $slot }}
</label>
