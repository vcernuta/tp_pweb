<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTagsGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_games', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')->nullable(true);
            $table->unsignedBigInteger('game_id')->nullable(true);
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null')->onUpdate('set null');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('set null')->onUpdate('set null');

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
        Schema::dropIfExists('tags_games');
    }
}
