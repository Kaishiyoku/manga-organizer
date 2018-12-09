<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Volume
 *
 * @property-read \App\Models\Manga $manga
 * @mixin \Eloquent
 * @property int $manga_id
 * @property int $number
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereMangaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereUpdatedAt($value)
 * @property int $id
 * @property int $no
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Volume query()
 */
class Volume extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no',
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
