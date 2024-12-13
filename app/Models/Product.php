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
        // 'sizes',
        // 'img',
        'type_fk',
        'cover',
        'cover_description'
    ];

    public function type(){
        return $this->belongsTo(Type::class, 'type_fk', 'type_id');
    }

    public function sizes(){
        return $this->belongsToMany(
            Size::class,
            'products_have_sizes',
            'product_fk',
            'size_fk',
            'product_id',
            'size_id'
        );
    }

    // Modelo Product
public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id')
        ->withPivot('quantity')  // Asegúrate de que 'quantity' está en la tabla pivote
        ->withTimestamps();  // Asegura que se gestionen automáticamente las marcas de tiempo
}

}
