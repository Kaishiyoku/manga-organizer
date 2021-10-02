<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Special
 *
 * @property int $id
 * @property int $manga_id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Manga $manga
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special whereMangaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Special query()
 */
class Special extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }
}
