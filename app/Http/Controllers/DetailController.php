<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('id', $id)->firstOrFail();

        $review = Review::where('products_id', $id)->count();
        $reviews = Review::with(['product', 'user'])->where('products_id', $id)->get();


        
        return view('pages.detail', [
            'product' => $product,
            'review' => $review,
            'reviews' => $reviews,
        ]);
    }

    public function add(Request $request, $id)
    {   
        $product = Product::where('id', $id)->first();
        if (!empty($product->discount_price)) {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
                'quantity_order' => $request->quantity_order,
                'total_price' => $product->discount_price*$request->quantity_order
            ];
        }else {
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
                'quantity_order' => $request->quantity_order,
                'total_price' => $product->price*$request->quantity_order
            ];
        }
       

        Cart::create($data);

        return redirect()->route('cart');
        
    }
}
