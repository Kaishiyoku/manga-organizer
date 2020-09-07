<h2 class="text-4xl">{{ __('special.title') }}</h2>

<div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white">
    @if ($manga->specials->count() == 0)
        <p><i>{{ __('manga.edit.no_specials_yet') }}</i></p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('validation.attributes.name') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($manga->specials as $special)
                    <tr>
                        <td>{{ $special->name }}</td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => ['specials.destroy', $manga, $special]])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ Form::open(['route' => ['specials.store', $manga], 'method' => 'post', 'role' => 'form', 'class' => 'px-4 pb-4']) }}
        <div class="flex mt-4">
            {{ Form::text('name', old('name', $newSpecial->name), ['class' => 'input-with-btn' . ($errors->has('name') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.name')]) }}

            {{ Form::button(__('special.new'), ['type' => 'submit', 'class' => 'btn-with-input']) }}
        </div>

        @if ($errors->has('name'))
            <p class="validation-error">
                {{ $errors->first('name') }}
            </p>
        @endif
    {{ Form::close() }}
</div>
