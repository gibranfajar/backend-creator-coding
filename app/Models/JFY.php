<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JFY extends Model
{
    protected $table = 'j_f_y_s';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'requirement',
        'description',
        'opportunity_id'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunities::class);
    }
}
