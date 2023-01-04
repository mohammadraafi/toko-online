<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'complaint', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(Complaint::class, 'id', 'id');
    }

    public function response()
    {
        return $this->hasOne(Responses::class,  'complaints_id', 'id');
    }
}
