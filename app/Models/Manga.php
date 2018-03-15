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
 */
class Manga extends Model
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

    public function volumes()
    {
        return $this->hasMany(Volume::class);
    }
}
