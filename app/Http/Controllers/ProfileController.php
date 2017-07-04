<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Auth;
use App\User;

class ProfileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $profile_pic = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) . "&s=" . "100";

        return view('dashboard', compact('user', 'profile_pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //Find user with ID else throw error.
        $user = User::findOrFail($id);

        //User can edit his/her profile not others
        if ($user && $user->id == Auth::user()->id ) {
          return view('profile.edit', compact('user'));
        }

        return redirect()->back()->withError('You are trying to access something weird, better stay away!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $user = User::findOrFail($id);

        if ($id == Auth::user()->id) {
          if($request->password == '') {
            $password = $user->password;
          } else {
            $password = bcrypt($request->password);
          }

          $this->validate($request, [
            'email' => ['nullable', 'email','min:3','max:255', Rule::unique('users')->ignore($user->id) ],
            'paypal_email' => ['nullable', 'email','min:3','max:255', Rule::unique('users','paypal_email')->ignore($user->id) ],
            'skrill_email' => ['nullable', 'email','min:3','max:255', Rule::unique('users','skrill_email')->ignore($user->id) ],
            'neteller_email' => ['nullable', 'email','min:3','max:255', Rule::unique('users','neteller_email')->ignore($user->id) ],
            'bitcoin_address' => ['nullable', 'string','min:3','max:255', Rule::unique('users','bitcoin_address')->ignore($user->id) ],
          ]);

          $user->update([
            'name' => $request->name,
            'email' => $request->email,

            'skrill_email' => $request->skrill_email,
            'neteller_email' => $request->neteller_email,
            'paypal_email' => $request->paypal_email,
            'bitcoin_address' => $request->bitcoin_address,

            'password' => $password,
          ]);

          return redirect()->route('dashboard')->withSuccess('Your profile updated successfully.');

        } else {
          return back()->withError('You are not allowed to edit this profile.');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
