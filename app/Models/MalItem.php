<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MalItem extends Model
{
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
        //
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
