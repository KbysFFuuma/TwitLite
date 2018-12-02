<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->integer('followingUserId')->unsigned();
            $table->integer('followedUserId')->unsigned();
            $table->timestamps();

            //外部キー設定
            $table->foreign('followingUserId')->references('id')->on('users');
            $table->foreign('followedUserId')->references('id')->on('users');

            //プライマリキー設定
            $table->unique(['followingUserId', 'followedUserId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
