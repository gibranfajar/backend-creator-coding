<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageArticle extends Model
{
    protected $table = 'page_articles';

    protected $fillable = [
        'title',
        'banner',
    ];
}
