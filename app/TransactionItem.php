<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(TransactionItem::class);
    }
}
