<h2>{{ __('volume.title') }}</h2>

<table class="table table-bordered table-striped table-sm">
    <thead>
    <tr>
        <th>{{ __('validation.attributes.no') }}</th>
        <th></th>
    </tr>
    </thead>

    @foreach ($manga->volumes as $volume)
        <tr>
            <td>{{ $volume->no }}</td>
            <td>
                @include('shared._delete_link', ['route' => ['volumes.destroy', $manga, $volume]])
            </td>
        </tr>
    @endforeach
</table>

{{ Html::linkRoute('volumes.create', __('volume.new'), [$manga]) }}