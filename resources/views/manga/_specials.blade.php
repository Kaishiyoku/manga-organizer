<h2 class="pt-4">{{ __('special.title') }}</h2>

@if ($manga->specials->count() == 0)
    <p><i>{{ __('manga.edit.no_specials_yet') }}</i></p>
@else
    <table class="table table-bordered table-striped table-sm">
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
                <td>
                    @include('shared._delete_link', ['route' => ['specials.destroy', $manga, $special]])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

{{ Form::open(['route' => ['specials.store', $manga], 'method' => 'post', 'role' => 'form']) }}
    <div class="input-group">
        {{ Form::text('name', old('name', $newSpecial->name), ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => true]) }}

        <div class="input-group-append">
            {{ Form::submit(__('special.new'), ['class' => 'btn btn-outline-primary']) }}
        </div>

        @if ($errors->has('no'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
{{ Form::close() }}