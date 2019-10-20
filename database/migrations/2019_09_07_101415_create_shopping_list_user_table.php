<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingListUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_list_user', function (Blueprint $table) {
            $table->unsignedBigInteger('shopping_list_id');
            $table->string('user_email');

            $table->unique(['shopping_list_id', 'user_email']);
            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists')->onDelete('cascade');
            $table->foreign('user_email')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_list_user');
    }
}
