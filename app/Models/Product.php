<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    // Datos que se pueden modificar
    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'img'
    ];
}
