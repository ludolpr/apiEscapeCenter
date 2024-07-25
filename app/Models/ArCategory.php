<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_category_ar',
        'description_category_ar',
    ];

    public function around()
    {
        return $this->hasMany(Around::class);
    }
}
