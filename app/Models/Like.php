<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = "likes";

    public function game() {
        return $this->hasOne(Game::class);
    }
}
