<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];


    // relacionamos con el usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // relacionamos con los productos
    public function products(){
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot ('quantity')
            ->withTimestamps();
    }
}
