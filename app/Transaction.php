<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'users_id',  'shipping_price', 'transaction_status','shipping_status','total_price', 'code', 'quantity_order', 'resi', 'point'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function poin()
    {
        return $this->hasOne(Poin::class, 'id', 'transactions_id');
    }
}
