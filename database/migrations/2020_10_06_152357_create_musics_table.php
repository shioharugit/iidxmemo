<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->string('version', 2)->nullable()->comment('バージョン');
            $table->string('title', 255)->comment('タイトル')->index();
            $table->string('genre', 255)->nullable()->comment('ジャンル');
            $table->string('artist', 255)->nullable()->comment('アーティスト');
            $table->string('bpm', 255)->nullable()->comment('BPM');
            $table->string('popular_name', 255)->nullable()->comment('俗称');
            $table->string('sp_beginner', 2)->nullable()->comment('SP BEGINNER難易度');
            $table->string('sp_normal', 2)->nullable()->comment('SP NORMAL難易度');
            $table->string('sp_hyper', 2)->nullable()->comment('SP HYPER難易度');
            $table->string('sp_another', 2)->nullable()->comment('SP ANOTHER難易度');
            $table->string('sp_leggendaria', 2)->nullable()->comment('SP LEGGENDARIA難易度');
            $table->string('dp_beginner', 2)->nullable()->comment('DP BEGINNER難易度');
            $table->string('dp_normal', 2)->nullable()->comment('DP NORMAL難易度');
            $table->string('dp_hyper', 2)->nullable()->comment('DP HYPER難易度');
            $table->string('dp_another', 2)->nullable()->comment('DP ANOTHER難易度');
            $table->string('dp_leggendaria', 2)->nullable()->comment('DP LEGGENDARIA難易度');
            $table->timestamp('deleted_at')->nullable()->comment('削除日');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musics');
    }
}
