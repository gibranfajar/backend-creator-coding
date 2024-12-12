<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misis';

    protected $fillable = [
        'image',
        'title_visi',
        'description_visi',
        'title_misi',
        'description_misi',
    ];
}
