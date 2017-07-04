<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = ['transaction_id', 'amount', 'payment_method', 'email', 'remark', 'screenshot', 'status'];

    public function user() {
      return $this->belongsTo(User::class);
    }
}
