<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAbout extends Model
{
    protected $table = 'page_abouts';

    protected $fillable = [
        'main_title',
        'banner',
        'title',
        'image',
        'description',
    ];
}
