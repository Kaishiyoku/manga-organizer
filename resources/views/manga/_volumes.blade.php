<h2 class="text-4xl">{{ __('volume.title') }}</h2>

<div class="rounded overflow-hidden shadow-lg border border-gray-200 bg-white">
    @if ($manga->volumes->count() == 0)
        <p class="px-4 pt-4 italic text-gray-500">{{ __('manga.edit.no_volumes_yet') }}</p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('validation.attributes.no') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($manga->volumes as $volume)
                    <tr>
                        <td>{{ $volume->no }}</td>
                        <td class="text-right">
                            @include('shared._delete_link', ['route' => ['volumes.destroy', $manga, $volume]])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{ Form::open(['route' => ['volumes.store', $manga], 'method' => 'post', 'role' => 'form', 'class' => 'px-4 pb-4']) }}
        <div class="flex mt-4">
            {{ Form::number('no', old('no', $newVolume->no), ['class' => 'input-with-btn' . ($errors->has('no') ? ' has-error' : ''), 'required' => true, 'placeholder' => __('validation.attributes.no')]) }}

            {{ Form::button(__('volume.new'), ['type' => 'submit', 'class' => 'btn-with-input']) }}
        </div>

        @if ($errors->has('no'))
            <p class="validation-error">
                {{ $errors->first('no') }}
            </p>
        @endif
    {{ Form::close() }}
</div>
