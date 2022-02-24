<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function get_historia() {
        return DB::table('historia')->first();
    }

    public function update_historia($content) {
        return $this->id;//DB::table('historia')->where('id', $id)->update(['content' => $content]);
    }
}
