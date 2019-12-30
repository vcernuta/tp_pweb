<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->timestamp('release_date')->nullable(false)->default(now());
            $table->integer('min_age')->default(3)->nullable(false);
            $table->string('min_max_player')->nullable(false);
            $table->string('min_max_duration')->nullable(false);
            $table->longText('description')->nullable(false);
            $table->longText('image')->nullable(false);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
