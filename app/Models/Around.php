<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Around extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_around',
        'description_around',
        'picture_around',
        'address_around',
        'town_around',
        'zipcode_around',
        'lat_around',
        'long_around',
        'id_category_ar'
    ];

    public function category_ar()
    {
        return $this->belongsTo(ArCategory::class);
    }
    public function escapes()
    {
        return $this->belongsToMany(EscapeGame::class);
    }
}