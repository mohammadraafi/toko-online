<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kritik extends Model
{
    use HasFactory;

    protected $fillable = [ 'users_id','kritik', 'saran', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function tanggapan()
    {
        return $this->hasOne(Responses::class, 'kritiks_id', 'id');
    }
}
