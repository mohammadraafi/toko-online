<?php

namespace App\Models;

use App\User;
use App\Models\Tanggapan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'keterangan', 'status', 'foto'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function details() {
        return $this->hasMany(Pengaduan::class, 'id', 'id');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class,  'pengaduans_id', 'id')->latestOfMany('status_pengaduan');
    }
}
