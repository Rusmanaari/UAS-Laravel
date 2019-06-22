<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_images');
    }
    public function categories()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function productReviews()
    {
    	return $this->hasMany('App\Models\productReview', 'product_id');
    }

    public function orderProducts($order_by) {
    	// $query = 'SELECT * FROM products ORDER BY created_at DESC';
    	// if ($order_by == 'best_seller') {
    	// 	$query ="SELECT p.*, oi.quantity FROM products AS p LEFT JOIN (SELECT product_id, SUM(quantity) as quantity from order_items GROUP BY product_id) AS oi ON oi.product_id = p.id ORDER BY oi.quantity DESC;";
    	// } else if ($order_by == 'terbaik'){
    	// 	$query = "SELECT * FROM products ORDER BY created_at DESC";
    	// } else if ($order_by == 'termurah'){
    	// 	$query = "SELECT * FROM products ORDER BY price ASC";
    	// } else if ($order_by == 'termahal'){
    	// 	$query = "SELECT * FROM products ORDER BY price DESC";
    	// } else if ($order_by == 'terbaru'){
    	// 	$query = "SELECT * FROM products ORDER BY created_at DESC";
    	// }
    	// return DB::select($query);
    	$query = DB::table('products')
    	->join('product_images','products.id','=','product_images.product_id')
    	->join('images','product_images.image_id','=','images.id');
        if ($order_by == 'best_seller')
        {
            // $query = "SELECT p.*, oi.quantity FROM products AS p LEFT JOIN (SELECT product_id, SUM(quantity) as quantity from order_items GROUP BY product_id) AS oi ON oi.product_id = p.id ORDER BY oi.quantity DESC";
            $query  ->leftJoin('order_items', 'order_items.product_id','=','products.id')
                    ->select(DB::raw('sum(order_items.quantity) as quantity, products.*'))
                    ->groupBy('products.id','products.user_id','products.category_id','products.name','products.price','products.description','products.image_url','products.vidio_url','products.created_at','products.updated_at')
                    ->orderBy('quantity','desc');
        }
 
        else if ($order_by == 'terbaik')
        {
            // $query = "SELECT p.*, r.rating FROM products AS p LEFT JOIN (SELECT product_id, AVG(rating) as rating from reviews GROUP BY product_id) AS r ON r.product_id = p.id ORDER BY r.rating DESC";
            $query  ->leftJoin('review', 'review.id_product','=','products.id')
                    ->select(DB::raw('avg(review.rating) as rating, products.*'))
                    ->groupBy('products.id','products.user_id','products.category_id','products.name','products.price','products.description','products.image_url','products.vidio_url','products.created_at','products.updated_at')
                    ->orderBy('rating','desc');
        } else if($order_by=='termurah'){
    		$query->orderBy('products.price','asc');
    	} else if($order_by=='termahal'){
            $query->orderBy('products.price','desc');
        } else if($order_by=='terbaru'){
            $query->orderBy('products.created_at','desc');
        } else if ($order_by == 'osprey'){
            $query->where('category_id',1);
        } else if ($order_by == 'eiger'){
            $query->where('category_id',2);
        } else if ($order_by == 'consina'){
            $query->where('category_id',3);
        } else if ($order_by == 'deuter'){
            $query->where('category_id',4);
        } else if ($order_by == 'gregori'){
            $query->where('category_id',5);
        }

    	return $query->paginate(4);
    }
    public function orderProducts1($order_by, $user_id) {
        $query = DB::table('products')
    	->join('product_images','products.id','=','product_images.product_id')
    	->join('images','product_images.image_id','=','images.id');
        if ($order_by == 'best_seller'){
            $query  ->leftJoin('order_items', 'order_items.product_id','=','products.id')
                    ->select(DB::raw('sum(order_items.quantity) as quantity, products.*'))
                    ->groupBy('products.id','products.user_id','products.category_id','products.name','products.price','products.description','products.image_url','products.vidio_url','products.created_at','products.updated_at')
                    ->orderBy('quantity','desc');
        }else if ($order_by == 'terbaik'){
            $query  ->leftJoin('review', 'review.id_product','=','products.id')
                    ->select(DB::raw('avg(review.rating) as rating, products.*'))
                    ->groupBy('products.id','products.user_id','products.category_id','products.name','products.price','products.description','products.image_url','products.vidio_url','products.created_at','products.updated_at')
                    ->orderBy('rating','desc');
        } else if($order_by=='termurah'){
    		$query->orderBy('products.price','asc');
    	} else if($order_by=='termahal'){
            $query->orderBy('products.price','desc');
        } else if($order_by=='terbaru'){
            $query->orderBy('products.created_at','desc');
        }
        return $query->where('products.user_id','=', $user_id)->paginate(3);
    }
}
