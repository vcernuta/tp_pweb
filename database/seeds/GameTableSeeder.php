<?php

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder {

    public function run() {
        factory(Game::class, 10)->create();
    }

}
