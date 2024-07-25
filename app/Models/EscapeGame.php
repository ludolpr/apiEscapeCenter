<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscapeGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_escape',
        'description_escape',
        'picture_escape',
        'address_escape',
        'town_escape',
        'zipcode_escape',
        'lat_escape',
        'long_escape',
        'id_category_eg',
    ];

    public function category_eg()
    {
        return $this->belongsTo(EgCategory::class);
    }
}