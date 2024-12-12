<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'category_product_id',
    ];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
