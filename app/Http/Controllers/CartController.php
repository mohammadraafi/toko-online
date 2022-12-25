<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
use Illuminate\Http\Request;
// use Kavist\RajaOngkir\Facades\RajaOngkir;
use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    private $apikey = '350ec8babba64ea9f1b5252153b855d3';

    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');

        // foreach ($carts as $cart) {
        //     $cart = Cart::findOrFail($cart->id);
        // }


        return view('pages.cart', [
            'carts' => $carts,
            'provinces' => $provinces,
            'couriers' => $couriers,
            // 'cart' => $cart
        ]);
    }


    public function update(Request $request)
    {
        // update quantity order dari keranjang
        DB::table('carts')->where('id', $request->id)->update([
            'quantity_order' => $request->quantity_order,
        ]);

        $cart = Cart::where('users_id', Auth::user()->id)->first();
        $product = Product::where('id', $cart->products_id)->first();

        if ($request->quantity_order == 1) {
            $cart->total_price =  $product->price*1;
            $cart->update();
        }elseif ($request->quantity_order == 2) {
            $cart->total_price =  $product->price*2;
            $cart->update();
        }elseif ($request->quantity_order == 3) {
            $cart->total_price =  $product->price*3;
            $cart->update();
        }elseif ($request->quantity_order == 4) {
            $cart->total_price =  $product->price*4;
            $cart->update();
        }elseif ($request->quantity_order == 5) {
            $cart->total_price =  $product->price*5;
            $cart->update();
        }elseif ($request->quantity_order == 6) {
            $cart->total_price =  $product->price*6;
            $cart->update();
        }elseif ($request->quantity_order == 7) {
            $cart->total_price =  $product->price*7;
            $cart->update();
        }elseif ($request->quantity_order == 8) {
            $cart->total_price =  $product->price*8;
            $cart->update();
        }elseif ($request->quantity_order == 9) {
            $cart->total_price =  $product->price*9;
            $cart->update();
        }else {
            $cart->total_price =  $product->price*10;
            $cart->update();
        }

        return redirect()->route('cart');
    }


    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');

        return json_encode($city);
    }

    public function submit(Request $request)
    {
        $rajaOngkir = new RajaOngkir($this->apikey);

        $biaya = $rajaOngkir->ongkosKirim([
            'origin'        => $request->city_origin,
            'destination'   => $request->city_destination,
            'weight'        => $request->weight,
            'courier'       => $request->courier
        ])->get();

        dd($biaya);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
