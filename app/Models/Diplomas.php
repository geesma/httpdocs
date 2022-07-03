<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplomas extends Model
{
    use HasFactory;

    #diploma belong to temporada
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
