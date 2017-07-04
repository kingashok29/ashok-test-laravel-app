<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CommissionController extends Controller
{
    public function addcommission($id) {
      $user = User::findOrFail($id);
      $refs = User::where('ref_username', $user->username)->get();

      return view('admin.users.add-commission', compact('user', 'refs'));
    }

    public function savecommission(Request $request,$id) {
      $user = User::findOrFail($id);
      $user->commissions()->create([
        'amount' => $request->amount,
        'paid_for' => $request->paid_for,
      ]);

      return redirect()->route('users.all')->withInfo('Commission has been added into users account');
    }
}
