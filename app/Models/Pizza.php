<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'image'
    ];

    public function ingredients(){

        return $this->belongsToMany(Ingredient::class, 'pizza_ingredients_pivot');
    }


}
