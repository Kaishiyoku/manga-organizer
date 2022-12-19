<x-app-layout>
    <x-slot name="header">
        <x-page-heading>
            {{ __('Recommendations') }}
        </x-page-heading>
    </x-slot>

    @if ($recommendations->isNotEmpty())
        <x-card.card class="divide-y dark:divide-gray-800">
            @foreach ($recommendations as $recommendation)
                <x-card.body class="flex justify-between">
                    <div>
                        <div>
                            {{ $recommendation->manga }}
                        </div>
                        <div class="text-muted text-sm">
                            <div>
                                {{ formatDateTime($recommendation->created_at) }}
                            </div>
                            <div>
                                {{ $recommendation->ip_address }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-button.button danger confirm :action="route('recommendations.destroy', $recommendation)" method="delete">
                            {{ __ ('Delete') }}
                        </x-button.button>
                    </div>
                </x-card.body>
            @endforeach
        </x-card.card>
    @else
        <x-empty-info>
            {{ __('No recommendations yet.') }}
        </x-empty-info>
    @endif
</x-app-layout>
