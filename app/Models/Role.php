<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_role',
        'description_role',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}