<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    protected $fillable = ['plan_id', 'amount'];
    protected $table = 'user_plans';

    public function user() {
      return $this->belongsTo(User::class);
    }
}
