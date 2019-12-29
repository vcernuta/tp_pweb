<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = "games";

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tags_games', 'game_id', 'tag_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function dislikes() {
        return $this->belongsToMany(User::class, 'dislikes');
    }

}
