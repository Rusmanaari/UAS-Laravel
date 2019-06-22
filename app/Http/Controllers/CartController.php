<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class CartController extends Controller
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
    public function index()
    {
        return view('carts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $product = Product::with('images')->find($id);
        if (!$product) {
            abort(404);
        }

        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image_url" => $product->images()->first()->image_src
                    ]
            ];

            session()->put('cart', $cart);
            return redirect('/carts')->with('success', 'Product added to cart successfully!');
        }
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect('/carts')->with('success', 'Product added to cart successfully!');
        }
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image_url" => $product->images()->first()->image_src
            ];

            session()->put('cart', $cart);
            return redirect('/carts')->with('success', 'Product added to cart successfully!');
        }

        public function update(Request $request)
        {
            if($request->id and $request->quantity)
            {
                $cart = session()->get('cart');
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                session()->flash('success', 'Cart updated successfully');
            }
        }

        public function remove(Request $request)
        {
            if($request->id) {
                $cart = session()->get('cart');
                if(isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }
                session()->flash('success', 'Product removed successfully');
            }
        }
    }
