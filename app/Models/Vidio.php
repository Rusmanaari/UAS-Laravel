<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vidio extends Model
{
    protected $fillable = [
        'vidio_title',
        'vidio_src',
        'vidio_desc',
    ];
}
