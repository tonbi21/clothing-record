<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coordinate_id');
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coordinate_id')->references('id')->on('coordinates')->onDelete('cascade');

            // user_idとcoordinate_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'coordinate_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
