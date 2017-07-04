<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plans';
    protected $fillable = [
      'plan_name', 'plan_duration', 'plan_info', 'starting_amount',
      'ending_amount', 'daily_profit', 'status'
    ];


    //Belongs to many relationship help to show user's their plans.
    public function user() {
      return $this->belongsToMany(User::class);
    }
}
