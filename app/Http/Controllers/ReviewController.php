<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\TransactionDetail;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::with(['transaction_detail', 'product', 'user'])->get();
        $satu = Review::where('rating', 'Buruk')->count();
        $dua = Review::where('rating', 'Kurang Baik')->count();
        $tiga = Review::where('rating', 'Cukup Baik')->count();
        $empat = Review::where('rating', 'Baik')->count();
        $lima = Review::where('rating', 'Sangat Baik')->count();

        return view('pages.admin.review.index', [
            'reviews' => $reviews,
            'satu' => $satu,
            'dua' => $dua,
            'tiga' => $tiga,
            'empat' => $empat,
            'lima' => $lima
        ]);
    }



    public function store(Request $request)
    {
        $data = $request->all();

        Review::create($data);

        return redirect()->back();
    }
}
