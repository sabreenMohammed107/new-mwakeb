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
        Schema::create('offer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_details_id')->nullable();
            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id')->references('id')->on('offers');
            $table->string("offer_title", 150);
            $table->string("offer_image", 200);
            $table->float("offer_cost");
            $table->float("total_cost");
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
        Schema::dropIfExists('offer_details');
    }
};
