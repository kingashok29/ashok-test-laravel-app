<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Events\SendActivationToken;

class ActivationController extends Controller {

  public function verifyEmail($token) {
    $user = User::where('activation_token', $token)->first();

    if(!$user) {
      return back()->withError('Your activation token either expired or not exist in database.');
    }

    $user->update([
      'verified' => true,
      'activation_token' => null,
    ]);

    return redirect()->route('login')
                     ->withSuccess('Your email confirmed, you can login now.');
  }

  public function resendEmail($username) {
    $user = User::whereUsername($username)->first();

    //Firing an event to resend activation email.
    event(new SendActivationToken($user, $user->activation_token));

    //Returning back to login page.
    return redirect()->route('login')
                     ->withInfo('Activation email sent successfully.');
  }
}
