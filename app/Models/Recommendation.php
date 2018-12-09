<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recommendation
 *
 * @property int $id
 * @property string $manga
 * @property string|null $ip_address
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation whereManga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recommendation query()
 */
class Recommendation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manga',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
