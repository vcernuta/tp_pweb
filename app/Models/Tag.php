<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'label'
    ];

    public function game() {
        return $this->belongsToMany(Game::class);
    }
}
