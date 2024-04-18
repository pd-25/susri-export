<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'slug'];

    protected $casts = [
        'image' => 'array', // Cast the 'image' attribute to an array
    ];

    protected $table = 'products';
}
