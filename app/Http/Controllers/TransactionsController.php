<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dikemass = Transaction::with(['user'])->where('users_id', auth()->user()->id)->where('shipping_status', 'Dikemas')->get();
        $dikirimm = Transaction::with(['user'])->where('users_id', auth()->user()->id)->where('shipping_status', 'Dikirim')->get();
        $selesaii = Transaction::with(['user'])->where('users_id', auth()->user()->id)->where('shipping_status', 'Pesanan sudah diterima')->get();


        return view('pages.transaksi', [
            'dikemass' => $dikemass,
            'dikirimm' => $dikirimm,
            'selesaii' => $selesaii,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transactionDetails = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                 ->where('transactions_id', $id)->get();

        return view('pages.detail-transaksi', [
            'transaction' => $transaction,
            'transactionDetails' => $transactionDetails
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function recieved($id)
    {
       $transaction =  Transaction::findOrFail($id)->update([
            'shipping_status' => 'Pesanan sudah diterima',
        ]);

        // $transaction = Transaction::where('users_id', Auth::user()->id)->get();

       

        // User::create([
        //     'poin' => $poin
        // ]);


        // Alert::success('Berhasil', 'Update status peminjaman berhasil');

        return redirect()->back();
    }
}
