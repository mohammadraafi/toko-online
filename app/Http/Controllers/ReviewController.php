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

        return view('pages.admin.review.index', [
            'reviews' => $reviews
        ]);

    }

    

    public function store(Request $request)
    {
        $data = $request->all();

        Review::create($data);

        return redirect()->back();
    }
}
