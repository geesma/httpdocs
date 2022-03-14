<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Temporada extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_temporada',
        'nom_any',
        'content',
        'order'
    ];

    public static function getLastTemporadaId() {
        return DB::table('temporadas')->select('id')->orderBy('nom_any', 'desc')->first();
    }

    public function ligas() {
        return $this->belongsToMany(Liga::class);
    }


    public function users($liga_id) {
        return $this->belongsToMany(User::class, 'liga_temporada')->where('liga_id', '=', $liga_id);
    }

    /**
     * Get all of the galleries for the Temporada
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

}
