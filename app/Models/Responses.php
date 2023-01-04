<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Responses extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'kritiks_id', 'responses',];

}
