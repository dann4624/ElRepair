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
        Schema::create('produkt_models', function (Blueprint $table) {
            $table->id();
            $table->string('navn');
            $table->integer('fabrikant_id');
            $table->integer('type_id');
            $table->timestamps();
            $table->foreign('fabrikant_id')->references('id')->on('fabrikants')->onDelete('cascade');;
            $table->foreign('type_id')->references('id')->on('produkt_types')->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produkt_models');
    }
};
