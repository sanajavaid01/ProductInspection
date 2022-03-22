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
        Schema::create('products_inspections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id');

            $table->unsignedBigInteger('inspection_id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('inspection_id')->references('id')->on('inspections')->onDelete('cascade');
          
            $table->json('inspection_steps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *php
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_inspections');
    }
};
