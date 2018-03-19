@extends('app')

@section('title', __('manga.index.title'))

@section('content')
    <h1>{{ __('manga.index.title') }}</h1>

    @auth
        {!! Html::decode(Html::linkRoute('mangas.manage', '<i class="fas fa-wrench"></i> ' . __('manga.index.manage'), [], ['class' => 'btn btn-secondary btn-sm'])) !!}
    @endauth

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if ($mangas->count() == 0)
                <p class="lead"><i>{{ __('manga.no_mangas_yet') }}</i></p>
            @else
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('validation.attributes.is_completed') }}</th>
                        <th>{{ __('validation.attributes.volume') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($mangas as $manga)
                        @foreach ($manga->volumes as $i => $volume)
                            <tr class="{{ $i == $manga->volumes->count() - 1  ? 'bordered-bold' : ''}}">
                                <td>
                                    @if ($i == 0)
                                        <strong>{{ $manga->name }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if ($i == 0)
                                        {{ formatBool($manga->is_completed) }}
                                    @endif
                                </td>
                                <td>{{ $volume->no }}</td>
                            </tr>
                        @endforeach

                        @foreach ($manga->specials as $i => $special)
                            <tr class="{{ $i == $manga->specials->count() - 1  ? 'bordered-bold' : ''}}">
                                <td>
                                    @if ($i == 0)
                                        <strong>{{ $manga->name }}</strong>
                                    @endif
                                </td>
                                <td></td>
                                <td>{{ $special->name }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection