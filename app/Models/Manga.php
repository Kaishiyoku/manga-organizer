<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manga
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Volume[] $volumes
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereUpdatedAt($value)
 * @property int $is_completed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereIsCompleted($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Special[] $specials
 * @property int|null $mal_id
 * @property-read \App\Models\MalItem $malItem
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manga query()
 * @property-read int|null $specials_count
 * @property-read int|null $volumes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Manga withVolumesAndSpecials()
 */
class Manga extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_completed', 'mal_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * Get mangas with volumes and specials
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithVolumesAndSpecials($query)
    {
        return $query->with(['volumes', 'specials'])
            ->has('volumes')
            ->orHas('specials')
            ->orderBy('name');
    }

    public function volumes()
    {
        return $this->hasMany(Volume::class)->orderBy('no');
    }

    public function specials()
    {
        return $this->hasMany(Special::class)->orderBy('name');
    }

    public function malItem()
    {
        return $this->hasOne(MalItem::class, 'mal_id', 'mal_id');
    }
}
