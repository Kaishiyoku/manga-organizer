<?php

use Illuminate\Database\QueryException;

if (! function_exists('handleIntegrityConstraintViolation')) {
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

if (! function_exists('generateHeadingLine')) {
    function generateHeadingLine($length, $char = '=')
    {
        return implode('', array_fill(0, $length, $char));
    }
}

if (! function_exists('generateAsciiHeading')) {
    function generateAsciiHeading($str, $char = '=')
    {
        $line = generateHeadingLine(strlen($str), $char);

        return $line . "\n" . \Illuminate\Support\Str::upper($str) . "\n" . $line;
    }
}

if (! function_exists('formatBool')) {
    function formatBool($bool)
    {
        return __('common.boolean.' . ($bool ? 'true' : 'false'));
    }
}

if (! function_exists('formatNumber')) {
    function formatNumber($number, $decimals = 0)
    {
        return number_format($number, $decimals, __('common.number.decimal_point'), __('common.number.thousands_seperator'));
    }
}
if (! function_exists('formatEmpty')) {
    function formatEmpty($str, $emptyStr = '/')
    {
        return $str ? $str : $emptyStr;
    }
}

if (! function_exists('fetchMalItemFor')) {
    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Jikan\Exception\ParserException
     * @throws \Jikan\Exception\BadResponseException
     */
    function fetchAndSaveMalItemFor($id)
    {
        $jikan = new \Jikan\MyAnimeList\MalClient();

        $malItem = \App\Models\MalItem::firstOrNew(['mal_id' => $id]);

        $mangaItem = $jikan->getManga(new \Jikan\Request\Manga\MangaRequest($malItem->mal_id));

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

        return $malItem;
    }
}