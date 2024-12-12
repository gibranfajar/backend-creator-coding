<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunities extends Model
{
    protected $table = 'opportunities';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
    ];
}
