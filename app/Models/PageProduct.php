<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageProduct extends Model
{
    protected $table = 'page_products';

    protected $fillable = [
        'main_title',
        'banner',
        'title',
        'image',
        'description',
    ];
}
