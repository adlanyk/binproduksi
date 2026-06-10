<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BinItem extends Model
{
    protected $fillable = ['bin_id', 'item_name', 'item_code', 'quantity', 'unit', 'notes'];

    public function bin(): BelongsTo
    {
        return $this->belongsTo(Bin::class);
    }
}
