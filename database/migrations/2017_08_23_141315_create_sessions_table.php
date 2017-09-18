<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('lesson_id');
            $table->text('content');
            $table->string('video');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });

        Schema::create('session_user', function (Blueprint $table) {
            $table->integer('session_id');
            $table->integer('user_id');
            $table->primary(['session_id', 'user_id']);
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
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('session_user');
    }
}
