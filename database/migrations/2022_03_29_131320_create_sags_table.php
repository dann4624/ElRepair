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
        Schema::create('sags', function (Blueprint $table) {
            $table->id();
            $table->integer('kunde_id');
            $table->integer('medarbejder_id');
            $table->integer('produkt_id');
            $table->integer('status_id');
            $table->integer('sagstype_id');
            $table->integer('afhentningstype_id');
            $table->text('beskrivelse');
            $table->dateTime('indlevering');
            $table->dateTime('status_skift');
            $table->string('chip_id');
            $table->timestamps();
            $table->foreign('kunde_id')->references('id')->on('kundes')->onDelete('cascade');;
            $table->foreign('medarbejder_id')->references('id')->on('medarbejders')->onDelete('cascade');;
            $table->foreign('produkt_id')->references('id')->on('produkts')->onDelete('cascade');;
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');;
            $table->foreign('sagstype_id')->references('id')->on('sag_types')->onDelete('cascade');;
            $table->foreign('afhentningstype_id')->references('id')->on('afhentningstypes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sags');
    }
};
