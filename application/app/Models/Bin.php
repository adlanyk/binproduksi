<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bin extends Model
{
    protected $fillable = ['code', 'name', 'type'];

    public function items(): HasMany
    {
        return $this->hasMany(BinItem::class)->orderBy('created_at', 'desc');
    }

    public function getCurrentItemAttribute()
    {
        return $this->items->first();
    }

    public function getIsFilledAttribute()
    {
        $current = $this->getCurrentItemAttribute();

        // Cek apakah ada item dan item_name bukan 'Kosong'
        if ($current && $current->item_name !== 'Kosong') {
            return true;
        }

        return false;
    }
}
