<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $fillable = [
        'name',
        'saldo_awal',
        'saldo_sekarang',
        'status'
    ];
}
