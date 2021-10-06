<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recommendations') }}
        </h2>
    </x-slot>

    @if ($recommendations->isNotEmpty())
        <x-card.card class="divide-y">
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
                        <x-delete-button :action="route('recommendations.destroy', $recommendation)" class="px-2 py-1"/>
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
