<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageFaq extends Model
{
    protected $table = 'page_faqs';

    protected $fillable = [
        'title',
        'banner',
    ];
}
