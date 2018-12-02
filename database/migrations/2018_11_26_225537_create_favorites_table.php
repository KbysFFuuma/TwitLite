<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('favorittingUserId')->unsigned();
            $table->integer('favoritedPostId')->unsigned();
            $table->timestamps();

            //外部キー設定
            $table->foreign('favorittingUserId')->references('id')->on('users');
            $table->foreign('favoritedPostId')->references('postId')->on('postTweets');

            //プライマリキー設定
            $table->unique(['favorittingUserId', 'favoritedPostId']);
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
