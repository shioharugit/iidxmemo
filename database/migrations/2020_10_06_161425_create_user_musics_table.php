<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_musics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->comment('ユーザーID');
            $table->bigInteger('music_id')->index()->comment('曲ID');
            $table->text('memo', 255)->comment('メモ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_musics');
    }
}
