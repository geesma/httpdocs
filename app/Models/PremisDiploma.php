<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremisDiploma extends Model
{
    use HasFactory;

    public function premio()
    {
        return $this->belongsTo('App\Models\Premio');
    }
}
