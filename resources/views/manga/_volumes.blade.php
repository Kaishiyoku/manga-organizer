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
                            <x-delete-button :action="route('volumes.destroy', [$manga, $volume])" class="px-2 py-1"/>
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

            <x-button>
                {{ __('Add') }}
            </x-button>
        {{ html()->closeModelForm() }}
    </x-card.body>
</x-card.card>
