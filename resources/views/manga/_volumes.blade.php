<h2 class="pt-4">{{ __('volume.title') }}</h2>

@if ($manga->volumes->count() == 0)
    <p><i>{{ __('manga.edit.no_volumes_yet') }}</i></p>
@else
    <table class="table table-bordered table-striped table-sm">
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
                <td>
                    @include('shared._delete_link', ['route' => ['volumes.destroy', $manga, $volume]])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

{{ Form::open(['route' => ['volumes.store', $manga], 'method' => 'post', 'role' => 'form']) }}
    <div class="input-group">
        {{ Form::number('no', old('no', $newVolume->no), ['class' => 'form-control' . ($errors->has('no') ? ' is-invalid' : ''), 'required' => true]) }}

        <div class="input-group-append">
            {{ Form::button(__('volume.new'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) }}
        </div>

        @if ($errors->has('no'))
            <div class="invalid-feedback">
                {{ $errors->first('no') }}
            </div>
        @endif
    </div>
{{ Form::close() }}