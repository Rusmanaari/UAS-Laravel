<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'user_id', 'status', 'total_price', 'shiping_address' , 'zip_code'
    ];

    public function user()
    {
    	return $this->belongTo('App\User');
    }

    public function orderItem()
    {
    	return $this->hasMany('App\Models\OrderItem');
    }
}
