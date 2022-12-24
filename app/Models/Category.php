<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
