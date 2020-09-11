<?php

use App\Models\MalItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Jikan\Model\Common\MalUrl;
use Jikan\MyAnimeList\MalClient;
use Jikan\Request\Manga\MangaRequest;

if (!function_exists('isAsText')) {
    function isAsText()
    {
        return session()->get('is_as_text');
    }
}

if (!function_exists('getViewByRequestType')) {
    /**
     * @param string|null $view
     * @param \Illuminate\Contracts\Support\Arrayable|array $data
     * @param array $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function getViewByRequestType($view = null, $data = [], $mergeData = [])
    {
        $prefix = session()->get('is_as_text') ? 'text.' : '';

        return view($prefix . $view, $data, $mergeData);
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
     * @throws \Jikan\Exception\BadResponseException
     * @throws \Jikan\Exception\ParserException
     */
    function fetchAndSaveMalItemFor(int $id): MalItem
    {
        $jikan = new MalClient();

        $malItem = MalItem::firstOrNew(['mal_id' => $id]);

        $mangaItem = $jikan->getManga(new MangaRequest($malItem->mal_id));

        $malItem->url = $mangaItem->getUrl();
        $malItem->title = $mangaItem->getTitle();
        $malItem->title_english = $mangaItem->getTitleEnglish();
        $malItem->title_japanese = $mangaItem->getTitleJapanese();
        $malItem->title_synonyms = implode(';', $mangaItem->getTitleSynonyms());
        $malItem->status = $mangaItem->getStatus();
        $malItem->image_url = $mangaItem->getImageUrl();
        $malItem->volumes = $mangaItem->getVolumes();
        $malItem->chapters = $mangaItem->getChapters();
        $malItem->publishing = $mangaItem->isPublishing();
        $malItem->rank = $mangaItem->getRank();
        $malItem->score = $mangaItem->getScore();
        $malItem->scored_by = $mangaItem->getScoredBy();
        $malItem->popularity = $mangaItem->getPopularity();
        $malItem->members = $mangaItem->getMembers();
        $malItem->favorites = $mangaItem->getFavorites();
        $malItem->synopsis = $mangaItem->getSynopsis();

        $malItem->save();

        $genreIds = collect($mangaItem->getGenres())
            ->map(function (MalUrl $malGenre) {
                return \App\Models\Genre::firstOrCreate(['name' => $malGenre->getName()])->id;
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
