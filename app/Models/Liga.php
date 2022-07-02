<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Liga extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subname',
        'color',
        'initials',
        'order',
        'content',
        'image_logo',
        'image_background'
    ];

    public function users() {
        return $this->hasMany(Users::class, 'liga_temporada');
    }

    public function temporadas() {
        return $this->belongsToMany(Temporada::class);
    }

    public static function getLigasToCreateOn($temporada_id) {
        return DB::select('SELECT * FROM ligas WHERE id not in (SELECT liga_temporada.liga_id from liga_temporada WHERE liga_temporada.temporada_id = ' . $temporada_id . ' GROUP BY liga_temporada.liga_id)');
    }

    public static function fillLiga($liga_id, $temporada_id, $player_id, $points) {
        if(DB::table('liga_temporada')->where('temporada_id', '=', $temporada_id)->where('liga_id', '=', $liga_id)->where('user_id', '=', $player_id)->count() > 0) {
            return DB::table('liga_temporada')->where('temporada_id', '=', $temporada_id)->where('liga_id', '=', $liga_id)->where('user_id', '=', $player_id)->update(['points'=> $points]);
        }
        return DB::table('liga_temporada')->insert(
            ['temporada_id' => $temporada_id, 'liga_id' => $liga_id, 'user_id' => $player_id, 'points' => $points]
        );
    }

    public static function deleteRowLiga($liga_id, $temporada_id, $player_id) {
        return DB::table('liga_temporada')->where([
            ['temporada_id', '=', $temporada_id],
            ['liga_id', '=', $liga_id],
            ['user_id', '=', $player_id],
        ])->delete();
    }
}
