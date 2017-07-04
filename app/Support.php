<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model {
    protected $table = 'support_tickets';
    protected $fillable = ['name', 'email', 'message', 'replied'];
}
