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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->string('github_id')->nullable()->unique();
            $table->string('vkontakte_id')->nullable()->unique();
            $table->dateTime('logged_in_at')->nullable();
            $table->dateTime('registered_at')->nullable();
            $table->dateTime('vkontakte_logged_in_at')->nullable();
            $table->dateTime('vkontakte_registered_at')->nullable();
            $table->dateTime('github_logged_in_at')->nullable();
            $table->dateTime('github_registered_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->dropColumn(['github_id', 'logged_in_at', 'registered_at','vkontakte_id','vkontakte_logged_in_at','vkontakte_registered_at','github_logged_in_at','github_registered_at']);
        });
    }
};
