<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('temporality_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('ticket');
            $table->string('folio')->nullable();
            $table->float('total')->default(0);
            $table->integer('points')->default(0);
            $table->boolean('validated')->default(0);
            $table->boolean('valid')->default(0);
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('temporality_id')->references('id')->on('temporalities');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
