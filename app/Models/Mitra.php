<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitra';
    protected $fillable = ['number', 'name', 'gender', 'nik', 'address', 'ktp', 'mou', 'status'];
}
