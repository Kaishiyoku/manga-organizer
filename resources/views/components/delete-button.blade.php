@props(['action'])

{{ html()->form('delete', $action)->open() }}
    <x-button data-confirm="{{ __('Are you sure?') }}" {{ $attributes->merge(['class'=> 'bg-red-600 hover:bg-red-700 active:bg-red-900 focus:border-red-600 focus:ring ring-red-300']) }}>
        <x-heroicon-s-trash class="w-5 h-5"/>
        <span>{{ __('Delete') }}</span>
    </x-button>
{{ html()->form()->close() }}
