@props(['url'])

<a href="{{ $url }}" class="text-purple-600 border-b-2 border-transparent hover:border-purple-200 transition">
    {{ $slot }}
</a>
