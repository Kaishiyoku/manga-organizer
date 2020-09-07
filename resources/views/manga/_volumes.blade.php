<h2 class="text-4xl">{{ __('volume.title') }}</h2>

@if ($manga->volumes->count() == 0)
    <p><i>{{ __('manga.edit.no_volumes_yet') }}</i></p>
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

{{ Form::open(['route' => ['volumes.store', $manga], 'method' => 'post', 'role' => 'form']) }}
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
