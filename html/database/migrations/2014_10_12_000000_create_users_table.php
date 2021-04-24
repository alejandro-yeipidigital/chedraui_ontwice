<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('birthday')->nullable();
            // $table->string('street')->nullable();
            // $table->string('number_int')->nullable();
            // $table->string('number_ext')->nullable();
            // $table->string('zip_code')->nullable();
            // $table->string('neighborhood')->nullable();
            // $table->string('municipality')->nullable();
            // $table->string('state')->nullable();
            $table->string('total_info')->nullable();
            $table->string('fb_email')->unique()->nullable();
            $table->string('fb_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->string('register_type')->default('formulario');
            $table->boolean('address_confirmed')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->boolean('active')->default(1);
            $table->text('observations')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
