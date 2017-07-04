<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['transaction_id', 'amount', 'payment_method', 'email', 'remark', 'status'];

    public function user() {
      return $this->belongsTo(User::class);
    }
}
