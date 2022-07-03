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

    public function users_season($liga_id, $temporada_id) {
        return $this->belongsToMany(User::class, 'liga_temporada')->where([
            ['liga_id', '=', $liga_id],
            ['temporada_id', '=', $temporada_id]
        ]);
    }

    public function get_user($user_id) {
        return DB::table('users')->where('id', '=', $user_id)->first();
    }

    public function get_winner($temporada_id, $liga_id) {
        return DB::table('liga_temporada')->where([
            ['liga_id', '=', $liga_id],
            ['temporada_id', '=', $temporada_id]
        ])->orderBy('points', 'desc')->first();
    }
    /**
     * Get all of the galleries for the Temporada
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function diplomas()
    {
        return $this->hasMany(Diplomas::class);
    }

}
