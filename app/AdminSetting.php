<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $fillable = ['paypal_email', 'skrill_email', 'neteller_email', 'bitcoin_address'];
}
