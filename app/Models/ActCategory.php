<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActCategory extends Model
{
    protected $table = 'act_category';
    protected $fillable = [
        'name',
        'status'
    ];
}
