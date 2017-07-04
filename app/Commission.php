<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = ['amount', 'paid_for'];

    public function user() {
      return $this->belongsTo(User::class);
    }
}
