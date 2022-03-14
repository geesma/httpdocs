<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LigaTemporada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liga_temporada', function (Blueprint $table) {
            $table->foreignId('temporada_id')->constrained();
            $table->foreignId('liga_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('total_points');
            $table->primary(['user_id', 'liga_id', 'temporada_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liga_temporada');
    }
}
