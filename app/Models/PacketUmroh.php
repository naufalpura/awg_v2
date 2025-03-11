<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacketUmroh extends Model
{
    protected $table = 'packet_umroh';
    protected $fillable = [
        'name',
        'schedule',
        'price',
        'dp',
        'status'
    ];
}
