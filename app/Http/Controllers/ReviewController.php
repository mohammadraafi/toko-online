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
        $satu = Review::where('rating', '1/5')->count();
        $dua = Review::where('rating', '2/5')->count();
        $tiga = Review::where('rating', '3/5')->count();
        $empat = Review::where('rating', '4/5')->count();
        $lima = Review::where('rating', '5/5')->count();

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
