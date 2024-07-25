<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscapeGameAround extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_around',
        'id_escape_game',
    ];

    public function escape_game()
    {
        return $this->hasMany(EscapeGame::class);
    }

    public function around()
    {
        return $this->hasMany(Around::class);
    }
}