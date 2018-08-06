<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //creates a table for friends of the user
        //it also determines whether the user has accepted your friend request
    Schema::create('friends', function (Blueprint $table){
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('friend_id');
        $table->boolean('accepted');
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
        Schema::drop('friends');
    }
}
