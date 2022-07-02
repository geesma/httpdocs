<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'temporada_id',
        'content'
    ];

    public function temporada()
    {
        return $this->belongsTo('App\Models\Temporada');
    }
}
