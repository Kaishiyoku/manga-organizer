@props(['action'])

{{ html()->form('delete', $action)->open() }}
    <button
        data-confirm="{{ __('Are you sure?') }}"
        {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center space-x-2 px-4 py-2 bg-red-700 dark:bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 dark:hover:bg-red-700 active:bg-red-900 dark:active:bg-red-600 focus:outline-none focus:border-red-900 focus:ring ring-red-500/50 disabled:opacity-25 transition ease-in-out duration-150']) }}
    >
        <x-heroicon-s-trash class="w-5 h-5"/>
        <span>{{ __('Delete') }}</span>
    </button>
{{ html()->form()->close() }}
