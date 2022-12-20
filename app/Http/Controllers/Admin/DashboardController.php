<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::where('roles', 'USER')->count();
        $revenue = Transaction::sum('total_price');
        $transactions = Transaction::count();
        $dikemas = Transaction::where('shipping_status', 'Dikemas')->count();
        $dikirim = Transaction::where('shipping_status', 'Dikirim')->count();
        $selesai = Transaction::where('shipping_status', 'Pesanan sudah diterima')->count();

        $total_price = Transaction::select(DB::raw("CAST(SUM(total_price) as int) as total_price"))
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('total_price');

        $bulan = Transaction::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan');

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transactions' => $transactions,
            'dikemas' => $dikemas,
            'dikirim' => $dikirim,
            'selesai' => $selesai,
            'total_price' => $total_price,
            'bulan' => $bulan
        ]);
    }
}
