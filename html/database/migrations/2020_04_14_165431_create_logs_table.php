<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->string('message');
            $table->boolean('verified')->default(0);
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status_logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs', function(Blueprint $table){
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('logs');
    }
}
