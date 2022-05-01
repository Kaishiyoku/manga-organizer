<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Social links') }}
        </x-page-heading>
    </x-slot>

    <div class="px-4 sm:px-0">
        <x-button-link :href="route('social_links.create')" class="mb-8">
            <x-heroicon-s-plus-circle class="w-5 h-5"/>
            <span>{{ __('Add social link') }}</span>
        </x-button-link>
    </div>

    @if ($socialLinks->isNotEmpty())
        <x-card.card class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($socialLinks as $socialLink)
                <a class="group block md:flex md:justify-between md:space-x-4 px-4 py-3 transition first:rounded-t-md last:rounded-b-md hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="{{ route('social_links.edit', $socialLink) }}">
                    <div class="flex space-x-2">
                        <div class="w-8 text-muted">{{ $socialLink->order }}</div>
                        <div>{{ $socialLink->title }}</div>
                    </div>
                    <div class="dark:group-hover:text-gray-400 text-muted">{{ $socialLink->url }}</div>
                </a>
            @endforeach
        </x-card.card>
    @else
        <x-empty-info>
            {{ __('No social links yet.') }}
        </x-empty-info>
    @endif
</x-app-layout>
