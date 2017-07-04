<?php

namespace App;

use Auth;
use App\Raf;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'paypal_email', 'neteller_email',
        'skrill_email','password','about', 'profile_pic', 'ref_username',
        'user_role', 'block', 'last_logged_in'
    ];

    protected $dates = ['last_logged_in'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function checkIfAdmin() {
      $user = Auth::user();

      if($user->user_role == 'admin') {
        return true;
      }
    }

    public function deposits() {
      return $this->hasMany(Deposit::class);
    }

    public function withdrawals() {
      return $this->hasMany(Withdrawal::class);
    }

    public function commissions() {
      return $this->hasMany(Commission::class);
    }

    public function plans() {
      return $this->hasMany(Plan::class);
    }

}
