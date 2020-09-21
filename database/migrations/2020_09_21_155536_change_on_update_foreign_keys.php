<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeOnUpdateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->dropForeign(['owner_email']);
            $table->foreign('owner_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['creator_email']);
            $table->foreign('creator_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('shopping_list_user', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->dropForeign(['owner_email']);
            $table->foreign('owner_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['creator_email']);
            $table->foreign('creator_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });

        Schema::table('shopping_list_user', function (Blueprint $table) {
            $table->dropForeign(['user_email']);
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }
}
