<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'category_article_id',
        'user_id',
    ];

    public function category_article()
    {
        return $this->belongsTo(CategoryArticle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
