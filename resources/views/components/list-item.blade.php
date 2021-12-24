@props(['label' => null, 'value' => null])

<div {{ $attributes->merge(['class' => 'flex justify-between even:bg-gray-800 px-4 py-2']) }}>
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
