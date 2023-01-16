<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::with(['user'])->get();


        return view('pages.admin.transactions.dashboard-transactions', [
            'transactions' => $transactions,
        ]);
    }

    public function details(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transactionDetails = TransactionDetail::with(['transaction', 'product'])
            ->where('transactions_id', $id)->get();

        $alamat = DB::table('addresses')
            ->join('cities', 'cities.city_id', '=', 'addresses.city_id')
            ->join('provinces', 'provinces.province_id', '=', 'cities.province_id')
            ->select('provinces.title as prov', 'cities.title as kota', 'addresses.*')
            // ->where('addresses.users_id', )
            ->get();

        return view('pages.admin.transactions.dashboard-transactions-details', [
            'transaction' => $transaction,
            'transactionDetails' => $transactionDetails,
            'alamat' => $alamat
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);
    }

    public function view_export()
    {
        return view('pages.admin.transactions.export');
    }

    public function export(Request $request)
    {
        if(isset($_GET['cari'])) {
            $transactions = Transaction::whereBetween('created_at', [$request->start_date, $request->end_date])->get();
            // dd($transactions);
            $pdf = Pdf::loadview('pages.admin.transactions.output-export',compact('transactions'));
            return $pdf->download('laporan-transaksi-penjualan.pdf');

        }
    }
}
