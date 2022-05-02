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
        Schema::create('kundes_addresses', function (Blueprint $table) {
            $table->integer('kunde_id');
            $table->integer('addresse_id');
            $table->foreign('kunde_id')->references('id')->on('kundes')->onDelete('cascade');
            $table->foreign('addresse_id')->references('id')->on('addresses')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
