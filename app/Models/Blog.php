<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_blog',
        'picture_blog',
        'description_blog',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}