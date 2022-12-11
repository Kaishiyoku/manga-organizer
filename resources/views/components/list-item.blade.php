@props(['label' => null, 'value' => null, 'striped' => false])

<div {{ $attributes->merge(['class' => classNames('flex justify-between py-2', ['even:bg-gray-800' => $striped])]) }}>
    @if ($label && $value)
        <div>
            {{ $label }}
        </div>

        <div>
            {{ $value }}
        </div>
    @else
        <div>
            {{ $slot }}
        </div>
    @endif
</div>
