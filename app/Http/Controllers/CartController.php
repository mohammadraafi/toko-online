<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Kavist\RajaOngkir\Facades\RajaOngkir;
use Kavist\RajaOngkir\RajaOngkir;


class CartController extends Controller
{   
    private $apikey = '350ec8babba64ea9f1b5252153b855d3';

    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');

        return view('pages.cart', [
            'carts' => $carts,
            'provinces' => $provinces,
            'couriers' => $couriers
        ]);
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
