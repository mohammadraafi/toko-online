<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Exception;
use App\Product;
use Midtrans\Snap;
use App\Transaction;
use Midtrans\Config;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();


        //lalu hitung jumlah berat total dari semua produk yang akan di beli
        $berattotal = 0;
        foreach ($carts as $cart) {
            $berat = $cart->product->weight * $cart->quantity_order;
            $berattotal = $berattotal + $berat;
        }

        //lalu ambil id kota si pelanngan
        $city = DB::table('addresses')->where('users_id', Auth::user()->id)->get();
        $city_destination =  $city[0]->city_id;

        //ambil id kota toko
        $alamat_toko = DB::table('store_addresses')->first();


        //lalu hitung ongkirnya
        $cost = RajaOngkir::ongkosKirim([
            'origin'  => $alamat_toko->id,
            'destination' => $city_destination,
            'weight' => $berattotal,
            'courier' => 'jne'
        ])->get();
        // dd($cost);

        //ambil hasil nya
        $ongkir =  $cost[0]['costs'][0]['cost'][0]['value'];

        //lalu ambil alamat user untuk ditampilkan di view
        $alamat_user = DB::table('addresses')
            ->join('cities', 'cities.city_id', '=', 'addresses.city_id')
            ->join('provinces', 'provinces.province_id', '=', 'cities.province_id')
            ->select('addresses.*', 'cities.title as kota', 'provinces.title as prov')
            ->where('addresses.users_id', Auth::user()->id)
            ->first();

        //buat kode invoice sesuai tanggalbulantahun dan jam
        $data = [
            'invoice' => 'ALV' . Date('Ymdhi'),
            'keranjangs' => $carts,
            'ongkir' => $ongkir,
            'alamat' => $alamat_user
        ];
        return view('pages.checkout', $data);
    }


    public function process(Request $request)
    {
        // Save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        $code = 'STORE-' . mt_rand(0000000, 999999);
        $carts = Cart::with(['product', 'user'])->where('users_id', Auth::user()->id)->get();

        $sumQuantity = Cart::where('users_id', Auth::user()->id)->sum('quantity_order');


        $point = $request->point;


        if ($request->total_price >= 100000 && $request->total_price <= 500000) {
            $poin = 5000;
        } elseif ($request->total_price >= 500000 && $request->total_price <= 1000000) {
            $poin = 10000;
        } else {
            $poin = 50000;
        }


        if ($point && Auth::user()->poin < $point) {
            Alert::error('Mohon maaf', 'Poin anda tidak cukup');

            return redirect()->back();
        } elseif ($point) {

            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'shipping_price' => $request->shipping_price,
                'total_price' => $request->total_price - $request->point,
                'transaction_status' => 'Sudah dibayar',
                'shipping_status' => 'Dikemas',
                'resi' => '',
                'quantity_order' => $sumQuantity,
                'code' => $code,
                'poin' => $request->poin
            ]);


            $sumPoin = User::where('id', Auth::user()->id)->first();
            $sumPoin->poin = $sumPoin->poin - $request->point;
            $sumPoin->update();

            $userPoin = User::where('id', Auth::user()->id)->first();
            $userPoin->poin =  $userPoin->poin + $poin;
            $userPoin->update();
        } else {
            $transaction = Transaction::create([
                'users_id' => Auth::user()->id,
                'shipping_price' => $request->shipping_price,
                'total_price' => $request->total_price - $request->point,
                'transaction_status' => 'Sudah dibayar',
                'shipping_status' => 'Dikemas',
                'resi' => '',
                'quantity_order' => $sumQuantity,
                'code' => $code,
            ]);

            $userPoin = User::where('id', Auth::user()->id)->first();
            $userPoin->poin =  $userPoin->poin + $poin;
            $userPoin->update();
        }

        // dd($transaction);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'code' => $trx
            ]);

            $product = Product::where('id', $cart->products_id)->first();
            $product->quantity = $product->quantity - $cart->quantity_order;
            $product->update();
        }

        Cart::where('users_id', Auth::user()->id)->delete();

        // Set your Merchant Server Key
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price - $request->point
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            Alert::success('Selamat', 'Anda mendapatkan poin');

            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
