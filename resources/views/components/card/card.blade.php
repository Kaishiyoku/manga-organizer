@props(['hoverable' => false])

<div {{ $attributes->merge(['class' => classNames('bg-white dark:bg-gray-800 dark:bg-opacity-50 shadow-md sm:rounded-md transition duration-200', ['hover:shadow-lg' => $hoverable])]) }}>
    {{ $slot }}
</div>
