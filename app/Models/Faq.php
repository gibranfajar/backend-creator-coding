<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'title',
        'description',
        'category_faq_id',
    ];

    public function categoryFaq()
    {
        return $this->belongsTo(CategoryFaq::class);
    }
}
