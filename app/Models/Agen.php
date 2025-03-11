<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agen extends Model
{
    protected $table = 'agen';
    protected $fillable = ['number', 'name', 'gender', 'nik', 'address', 'ktp', 'mou', 'status', 'mitra_id'];

    function mitra(): BelongsTo
    {

        return $this->belongsTo(Mitra::class, 'mitra_id', 'id');
    }
}
