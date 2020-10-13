<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('login_id', 20)->nullable()->index()->comment('ログインID');
            $table->string('email', 255)->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('メール認証日');
            $table->string('email_verify_token')->nullable()->comment('メール認証用トークン');
            $table->string('password', 255)->nullable()->comment('パスワード');
            $table->rememberToken()->comment('ログイン次回から入力を省略用トークン');
            $table->timestamp('deleted_at')->nullable()->comment('削除日');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日');
        });
        DB::statement('ALTER TABLE admins MODIFY login_id varchar(20) BINARY');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
