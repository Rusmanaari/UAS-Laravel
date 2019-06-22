<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "review";
    protected $fillable = [
        'id_product', 'id_user', 'review', 'rating'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User','id_user');
    }
}
