<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jamaah extends Model
{
    protected $table = 'jamaah';
    protected $fillable = [
        'register_date',
        'number',
        'phone',
        'name',
        'gender',
        'nik',
        'packet_umroh_id',
        'nominal',
        'mitra_id',
        'agen_id',
        'freelancer_id',
        'form',
        'akad',
        'proof',
        'ktp',
        'status',
        'description',
    ];

    function packetUmroh(): BelongsTo
    {

        return $this->belongsTo(PacketUmroh::class, 'packet_umroh_id', 'id');
    }

    function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id');
    }
    function agen(): BelongsTo
    {
        return $this->belongsTo(Agen::class, 'agen_id', 'id');
    }
    function freelancer(): BelongsTo
    {
        return $this->belongsTo(Freelancer::class, 'freelancer_id', 'id');
    }
}
