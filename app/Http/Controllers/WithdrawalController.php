<?php

namespace App\Http\Controllers;

use App\Withdrawal;
use Auth;
use Illuminate\Http\Request;

use App\User;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.withdraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

      $or_user = User::findOrFail($id);
      $user = Auth::user();

      if($user->id !== $or_user->id) {
        return redirect()->route('dashboard')->withWarning('One more bad attempt and your account will be blocked, thanks :)');
      }

        $this->validate($request, [
          'amount' => 'required|numeric',
          'payment_method' => 'required',
          'email' => 'required|email',
          'message' => 'nullable'
        ]);

        $balance = Auth::user()->deposits()->sum('amount');

        if($request->amount > $balance) {
          return redirect()->back()->withError('You can not withdraw more then available amount');
        }

        Auth::user()->withdrawals()->create([
          'amount' => $request->amount,
          'payment_method' => $request->payment_method,
          'email' => $request->email,
          'message' => $request->message
        ]);

        return redirect()->route('withdraw.new', Auth::user()->id)->withSuccess('Your withdrawal request submitted, please check history page for status.');
    }

    public function approve(Request $request, $id) {

      $this->validate($request, [
        'transaction_id' => 'required|min:4',
      ]);

      $w = Withdrawal::findOrFail($id);
      $w->update([
        'status' => true,
        'transaction_id' => $request->transaction_id,
      ]);
      return redirect()->route('pending.withdrawals')->withSuccess('Withdraw request approved and fund deduced from user account.');
    }

    public function delete($id) {
      $w = Withdrawal::findOrFail($id);
      $w->delete();

      return redirect()->route('pending.withdrawals')->withInfo('This spammy request has been deleted!');
    }

    public function addWithdrawal($id) {
      $user = User::findOrFail($id);
      return view('admin.users.add-withdrawal', compact('user'));
    }

    public function saveWithdrawal(Request $request,$id) {
      $user = User::findOrFail($id);

      $user->withdrawals()->create([
        'amount' => $request->amount,
        'payment_method' => $request->payment_method,
        'email' => $request->email,
        'status' => true,
      ]);

      return redirect()->route('users.all')->withInfo('withdrawal added into users account');
    }


}
