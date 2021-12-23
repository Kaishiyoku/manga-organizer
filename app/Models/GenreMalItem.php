<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\GenreMalItem
 *
 * @property int $id
 * @property int $mal_item_id
 * @property int $genre_id
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GenreMalItem whereMalItemId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Genre $genre
 * @property-read \App\Models\MalItem $malItem
 */
class GenreMalItem extends Pivot
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function malItem()
    {
        return $this->belongsTo(MalItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
