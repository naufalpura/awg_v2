<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Freelancer extends Model
{
    protected $table = 'freelancer';
    protected $fillable = ['number', 'name', 'gender', 'nik', 'address', 'ktp', 'mou', 'status', 'agen_id'];

    function agen(): BelongsTo
    {

        return $this->belongsTo(Agen::class, 'agen_id', 'id');
    }
}
