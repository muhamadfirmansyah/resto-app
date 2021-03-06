<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
