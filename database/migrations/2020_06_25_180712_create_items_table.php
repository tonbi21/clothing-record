<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            // 追加分
            $table->unsignedBigInteger('user_id');
            $table->string('name', 100);
            $table->string('item_image_url', 100);
            $table->string('brand', 30);
            $table->integer('category_id');
            $table->integer('gender');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
