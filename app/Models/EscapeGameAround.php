<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscapeGameAround extends Model
{
    use HasFactory;

    protected $fillable = [
        'around_id',
        'escape_game_id',
    ];

    public function escape_game()
    {
        return $this->belongsToMany(EscapeGame::class);
    }

    public function around()
    {
        return $this->belongsToMany(Around::class);
    }
}