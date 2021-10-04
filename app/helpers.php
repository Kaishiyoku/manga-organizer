<?php

use App\Models\Genre;
use App\Models\MalItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

if (!function_exists('isAsText')) {
    function isAsText()
    {
        return session()->get('is_as_text');
    }
}

if (!function_exists('handleIntegrityConstraintViolation')) {
    function handleIntegrityConstraintViolation($message, Closure $closure)
    {
        try {
            $closure();
        } catch (QueryException $e) {
            if ($e->errorInfo[0] == 23000) {
                flash($message)->error();
            }
        }
    }
}

if (!function_exists('generateHeadingLine')) {
    function generateHeadingLine($length, $char = '=')
    {
        return implode('', array_fill(0, $length, $char));
    }
}

if (!function_exists('generateAsciiHeading')) {
    function generateAsciiHeading($str, $char = '=')
    {
        $line = generateHeadingLine(strlen($str), $char);

        return $line . "\n" . Str::upper($str) . "\n" . $line;
    }
}

if (!function_exists('formatBool')) {
    function formatBool($bool)
    {
        return __('common.boolean.' . ($bool ? 'true' : 'false'));
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($number, $decimals = 0)
    {
        return number_format($number, $decimals, __('common.number.decimal_point'), __('common.number.thousands_seperator'));
    }
}
if (!function_exists('formatEmpty')) {
    function formatEmpty($str, $emptyStr = '/')
    {
        return $str ? $str : $emptyStr;
    }
}

if (!function_exists('fetchMalItemFor')) {
    /**
     * @param int $id
     * @return MalItem
     */
    function fetchAndSaveMalItemFor(int $id): MalItem
    {
        $malItem = MalItem::firstOrNew(['mal_id' => $id]);

        $mangaData = Http::get(env('MANGA_SEARCH_API_BASE_URL') . '/manga/' . $id)->json();

        $malItem->url = Arr::get($mangaData, 'url');
        $malItem->title = Arr::get($mangaData, 'title');
        $malItem->title_english = Arr::get($mangaData, 'title_english');
        $malItem->title_japanese = Arr::get($mangaData, 'title_japanese');
        $malItem->title_synonyms = implode(';', Arr::get($mangaData, 'title_synonyms'));
        $malItem->status = Arr::get($mangaData, 'status');
        $malItem->image_url = Arr::get($mangaData, 'image_url');
        $malItem->volumes = Arr::get($mangaData, 'volumes');
        $malItem->chapters = Arr::get($mangaData, 'chapters');
        $malItem->publishing = Arr::get($mangaData, 'publishing');
        $malItem->rank = Arr::get($mangaData, 'rank');
        $malItem->score = Arr::get($mangaData, 'scored');
        $malItem->scored_by = Arr::get($mangaData, 'scored_by');
        $malItem->popularity = Arr::get($mangaData, 'popularity');
        $malItem->members = Arr::get($mangaData, 'members');
        $malItem->favorites = Arr::get($mangaData, 'favorites');
        $malItem->synopsis = Arr::get($mangaData, 'synopsis');

        $malItem->save();

        $genreIds = collect(Arr::get($mangaData, 'genres'))
            ->map(function ($genre) {
                return Genre::firstOrCreate(['name' => Arr::get($genre, 'name')])->id;
            });

        $malItem->genres()->detach();
        $malItem->genres()->attach($genreIds);

        return $malItem;
    }
}

if (!function_exists('intRangeToStr')) {
    function intRangeToStr(Collection $range)
    {
        if ($range->count() <= 1) {
            return $range->join('');
        }

        $numbers = collect($range)->combine(collect($range));
        $missingNumbers = collect(range($numbers->first(), $numbers->last()))->diff($numbers);
        $diff = $missingNumbers->combine($missingNumbers);

        $numberStrGroups = Str::of(
            $numbers->reduce(function ($accum, $number) use ($diff) {
                $suffix = $diff->has($number + 1) ? '|' : ',';

                return $accum . $number . $suffix;
            }, '')
        )
            ->trim(',')
            ->explode('|');

        return Str::of(
            $numberStrGroups
                ->map(function ($subStr) {
                    return Str::of($subStr)->explode(',');
                })
                ->reduce(function (Stringable $accum, Collection $strArr) {
                    if ($strArr->count() > 2) {
                        return Str::of($accum . $strArr->first() . '-' . $strArr->last() . ', ');
                    }

                    return Str::of($accum . $strArr->implode(', ') . ', ');
                }, Str::of(''))
                ->trim(', ')
        );
    }
}
