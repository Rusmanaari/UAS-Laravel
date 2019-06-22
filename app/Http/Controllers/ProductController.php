<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Image;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products=Product::all();
        $orderBy = $request->get('order_by');
        $productInstance = new Product();
        $products = $productInstance->orderProducts($orderBy)->all();

        if($request->ajax()){
            return response()->json($products, 200);
        }

        return view('products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $review = Review::where('id_product', $id)->get();
        // $user = User::where('id', $review[0]['id_user'])->get();
        // return $user;
        // $review = DB::table('review')
        //     ->join('users', 'review.id_user', '=', 'users.id')
        //     ->select('review.*', 'users.name')
        //     ->where('review.id_product', $id)->get();
        $product = Product::find($id);
        $reviews = Review::where('id_product',$product->id)->get();
        if ($product) {
            return view('products.show', compact('product', 'reviews'));
        } else {
            return redirect('/products')->with('errors', 'Produk tidak ditemukan');
        }
    }

    public function image($imageName)
    {
        $file = public_path(env('/images').'products/'. $imageName);
        return Image::make($file)->response();
    }
}