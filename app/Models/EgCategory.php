<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EgCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_category_eg',
        'description_category_eg',
    ];

    public function escape_game()
    {
        return $this->hasMany(EscapeGame::class);
    }
}