<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_games', function (Blueprint $table) {
            $table->id();
            $table->integer("participation_id");
            $table->integer("life");
            $table->integer("points")->default(0);
            $table->string("status_game")->default("Started"); // We have to have (iniciado, browser recargado, finalizado)
            $table->integer("status")->default(1); // 1 = started, 2 = finished, 3 = Reloaded, 4 = Abandoned, 5 = Manual score
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
        Schema::dropIfExists('user_games');
    }
}
