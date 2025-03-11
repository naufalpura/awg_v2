<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActSubCategory extends Model
{
    protected $table = 'act_sub_category';
    protected $fillable = [
        'name',
        'act_category_id',
        'status'
    ];

    function category(): BelongsTo
    {
        return $this->belongsTo(ActCategory::class, 'act_category_id', 'id');
    }
}
