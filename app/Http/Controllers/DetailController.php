<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        
        return view('pages.detail', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {   
        $product = Product::where('id', $id)->first();

        if($request->quantity_order >= $product->quantity)
        {
            return redirect()->back()->with(['error' => 'Jumlah Stok Tidak Mencukupi Jumlah Pesan Anda']);
        }

        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
            'quantity_order' => $request->quantity_order,
            'total_price' => $product->price*$request->quantity_order
        ];

       

        Cart::create($data);

        return redirect()->route('cart');
        
    }
}
