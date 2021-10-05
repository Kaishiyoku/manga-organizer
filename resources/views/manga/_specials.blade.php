<x-card.card>
    <x-card.header>
        {{ __('Specials') }}
    </x-card.header>


    @if ($manga->specials->count() === 0)
        <p class="px-4 pt-4 italic text-gray-500">{{ __('No specials yet.') }}</p>
    @else
        <table class="table table-hover">
            <tbody>
                @foreach ($manga->specials as $special)
                    <tr>
                        <td>{{ $special->name }}</td>
                        <td class="text-right">
                            <x-delete-button :action="route('specials.destroy', [$manga, $special])" class="px-2 py-1"/>
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

                <x-input id="special_name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $newSpecial->name)" required/>

                <x-validation-error for="name"/>
            </div>

            <x-button>
                {{ __('Add') }}
            </x-button>
        {{ html()->closeModelForm() }}
    </x-card.body>
</x-card.card>
