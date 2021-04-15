<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('winners')->default(0);
            $table->datetime('start');
            $table->datetime('end');
            $table->boolean('finalized')->default(0);
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
        Schema::dropIfExists('temporalities');
    }
}
