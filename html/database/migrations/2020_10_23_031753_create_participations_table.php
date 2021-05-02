<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("temporality_id");
            $table->integer("validation"); // 1 = pendiente, 2 = validado, 3 = rechazado
            $table->string("ticket");
            $table->string("played_lifes")->default(0);
            $table->string("ticket_code");
            $table->integer("total_points")->default(0);
            $table->integer("status")->default(1); // 1 = active, 2 = finished, 3 = abandoned 
            $table->string('region')->nullable();
            $table->string('main_product')->nullable();
            $table->string('store')->nullable();
            $table->string('pay')->nullable();
            $table->string('total_ticket')->nullable();
            $table->text('reason')->nullable();
            $table->string('other_products')->nullable();

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
        Schema::dropIfExists('participations');
    }
}
