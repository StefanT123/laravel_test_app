<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Slugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules', function(Blueprint $table) {

            $table->string('slug');

        });

        Schema::table('lessons', function(Blueprint $table) {

            $table->string('slug');

        });

        Schema::table('sessions', function(Blueprint $table) {

            $table->string('slug');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
