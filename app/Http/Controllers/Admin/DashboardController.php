<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::sum('total_price');
        $transactions = Transaction::count();
        $dikemas = Transaction::where('shipping_status', 'Dikemas')->count();
        $dikirim = Transaction::where('shipping_status', 'Dikirim')->count();
        $selesai = Transaction::where('shipping_status', 'Pesanan sudah diterima')->count();
        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transactions' => $transactions,
            'dikemas' => $dikemas,
            'dikirim' => $dikirim,
            'selesai' => $selesai
        ]);
    }
}
