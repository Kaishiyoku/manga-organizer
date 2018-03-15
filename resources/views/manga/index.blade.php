@extends('app')

@section('title', __('manga.index.title'))

@section('content')
    <h1>{{ __('manga.index.title') }}</h1>

    @auth
        {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-wrench"></i> ' . __('manga.index.manage'), [], ['class' => 'btn btn-secondary btn-sm'])) !!}
    @endauth

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>{{ __('validation.attributes.name') }}</th>
                    <th>{{ __('validation.attributes.volume') }}</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($mangas as $manga)
                    @foreach ($manga->volumes as $volume)
                        <tr>
                            <td>{{ $manga->name }}</td>
                            <td>{{ $volume->no }}</td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection