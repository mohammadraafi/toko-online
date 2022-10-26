<?php

namespace App\Models;

use App\User;
use App\Product;
use App\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['users_id','transaction_detail_id', 'products_id', 'rating', 'comment'];

    public function transaction_detail()
    {
        return $this->hasOne(TransactionDetail::class, 'id', 'transaction_detail_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
