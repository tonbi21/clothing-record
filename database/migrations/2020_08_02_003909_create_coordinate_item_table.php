<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('coordinate_id');
            $table->timestamps();
            
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('coordinate_id')->references('id')->on('coordinates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate_item');
    }
}
