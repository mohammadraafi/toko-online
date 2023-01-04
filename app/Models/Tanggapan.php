<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'pengaduans_id', 'tanggapan',  'status_pengaduan'
    ];

    public function pengaduan()
    {
    	return $this->hasOne(Pengaduan::class,'id', 'id');
    }

}
