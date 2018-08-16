<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MalItem
 *
 * @property int $mal_id
 * @property string|null $link_canonical
 * @property string|null $title
 * @property string|null $title_english
 * @property string|null $title_japanese
 * @property string|null $title_synonyms
 * @property string|null $status
 * @property string|null $image_url
 * @property string|null $volumes
 * @property string|null $chapters
 * @property bool $publishing
 * @property int|null $rank
 * @property float|null $score
 * @property int|null $scored_by
 * @property int|null $popularity
 * @property int|null $members
 * @property int|null $favorites
 * @property string|null $synopsis
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Manga[] $mangas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereChapters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereFavorites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereLinkCanonical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereMalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem wherePublishing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereScoredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereSynopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereTitleEnglish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereTitleJapanese($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereTitleSynonyms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereVolumes($value)
 * @mixin \Eloquent
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MalItem whereUrl($value)
 */
class MalItem extends Model
{
    protected $primaryKey = 'mal_id';

    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'publishing' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mal_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function mangas()
    {
        return $this->belongsToMany(Manga::class)->orderBy('name');
    }
}
