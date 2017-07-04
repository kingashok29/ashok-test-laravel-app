<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use App\Ref;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Events\SendActivationToken;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
            'ref_username' => 'nullable|exists:users,username',
            'agree' => 'agree',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_role' => 'user',
            'ref_username' => $data['ref_username'],
            'agree' => 'agree',

            'activation_token' => str_random(65),
        ]);

      }

      protected function registered($user) {

          $user = Auth::user();

          //Fire an event to send verification email.
          event(new SendActivationToken($user, $user->activation_token));

          //Log out user.
          Auth::logout();

          return redirect()->route('login')
                           ->withInfo('Your account successfully created, Please check your email to verify account.');

    }

}
