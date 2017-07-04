<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

    public function index() {
      //Fetch all user list from database to show in admin panel.
      $users = User::all();
      return view('admin.users.index', compact('users'));
    }

    public function block($id) {
      $user = User::findOrFail($id);
      $user->update([
        'block' => true
      ]);

      return redirect()->back()->withSuccess('User blocked successfully, user can not login now.');
    }

    public function unblock($id) {
      $user = User::findOrFail($id);
      $user->update([
        'block' => false
      ]);

      return redirect()->back()->withSuccess('User unblocked successfully, user can login now.');
    }

    public function view($id) {
      $user = User::findOrFail($id);
      $refs = User::where('ref_username', $user->username)->get();
      return view('admin.users.view', compact('user', 'refs'));
    }

}
