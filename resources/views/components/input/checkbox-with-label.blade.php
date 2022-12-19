@props(['for', 'name', 'id', 'label'])

<x-input.label :for="$for">
    <div class="flex items-center">
        <x-input.checkbox :name="$name" :id="$id" {{ $attributes }}/>
        <span class="ml-2 text-sm">{{ $label }}</span>
    </div>
</x-input.label>
