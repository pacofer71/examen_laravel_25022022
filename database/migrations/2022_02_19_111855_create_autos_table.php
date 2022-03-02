<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->enum('marca', ['Audi', 'Fiat', 'Jeep', 'Peugeot', 'Opel', 'Renault', 'Seat', 'Toyota']);
            $table->unsignedInteger('kms');
            $table->string('foto')->default('noimage.jpg');
            $table->enum('reservado', [1,2])->nullable(); //1 NO , 2 Si
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('autos');
    }
};
