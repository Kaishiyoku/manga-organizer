<x-card.card>
    <x-card.header>
        {{ __('Volumes') }}
    </x-card.header>


    @if ($manga->volumes->count() === 0)
        <x-empty-info class="px-4 pt-4">
            {{ __('No volumes yet.') }}
        </x-empty-info>
    @else
        <table class="table table-hover">
            <tbody>
                @foreach ($manga->volumes as $volume)
                    <tr>
                        <td>{{ $volume->no }}</td>
                        <td class="text-right">
                            <x-button.button danger confirm icon-only :action="route('volumes.destroy', [$manga, $volume])" method="delete" :title="__('Delete')">
                                <x-heroicon-s-trash/>
                            </x-button.button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <x-card.body>
        {{ html()->modelForm($newVolume, 'post', route('volumes.store', $manga))->open() }}
            <div class="mb-4">
                <x-label for="volume_no" :value="__('validation.attributes.no')" required/>

                <x-input id="volume_no" class="block mt-1 w-full" type="number" name="no" :value="old('no', $newVolume->no)" required/>

                <x-validation-error for="no"/>
            </div>

            <x-button.button primary type="submit">
                <x-heroicon-s-plus/>
                <span>{{ __('Add') }}</span>
            </x-button.button>
        {{ html()->closeModelForm() }}
    </x-card.body>
</x-card.card>
