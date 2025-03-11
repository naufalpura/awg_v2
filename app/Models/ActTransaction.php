<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActTransaction extends Model
{
    protected $table = 'act_transaction';
    protected $fillable = [
        'date',
        'act_sub_category_id',
        'description',
        'bank_id',
        'nominal',
        'type'
    ];

    function subCategory(): BelongsTo
    {
        return $this->belongsTo(ActSubCategory::class, 'act_sub_category_id', 'id');
    }
    function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
