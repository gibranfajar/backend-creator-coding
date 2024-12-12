<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageCareer extends Model
{
    protected $table = 'page_careers';

    protected $fillable = [
        'main_title',
        'banner',
        'title',
        'image',
        'description',
    ];
}
