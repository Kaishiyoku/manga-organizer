<x-card.card>
    <x-card.header>
        {{ __('Specials') }}
    </x-card.header>


    @if ($manga->specials->count() === 0)
        <x-empty-info class="px-4 pt-4">
            {{ __('No specials yet.') }}
        </x-empty-info>
    @else
        <table class="table table-hover">
            <tbody>
                @foreach ($manga->specials as $special)
                    <tr>
                        <td>{{ $special->name }}</td>
                        <td class="text-right">
                            <x-button.button danger confirm icon-only :action="route('specials.destroy', [$manga, $special])" method="delete" :title="__('Delete')">
                                <x-heroicon-s-trash/>
                            </x-button.button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <x-card.body>
        {{ html()->modelForm($newSpecial, 'post', route('specials.store', $manga))->open() }}
            <div class="mb-4">
                <x-label for="special_name" :value="__('validation.attributes.name')" required/>

                <x-input.input id="special_name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $newSpecial->name)" required/>

                <x-validation-error for="name"/>
            </div>

            <x-button.button primary type="submit">
                <x-heroicon-s-plus/>
                <span>{{ __('Add') }}</span>
            </x-button.button>
        {{ html()->closeModelForm() }}
    </x-card.body>
</x-card.card>
