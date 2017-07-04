<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\Deposit;
use App\withdrawal;

class HistoryController extends Controller
{
    public function index() {

      $deposits = DB::table('deposits')->where('user_id', '=', Auth::user()->id)
                                       ->get();

      $withdrawals = DB::table('withdrawals')->where('user_id', '=', Auth::user()->id)
                                          ->get();

      return view('finance.history', compact('deposits', 'withdrawals'));
    }

    public function myBalance() {

      $deposit = DB::table('deposits')->where('user_id', '=', Auth::user()->id)
                                       ->where('status', true)
                                       ->sum('amount');

      $withdrawal = DB::table('withdrawals')->where('user_id', '=', Auth::user()->id)
                                        ->where('status', true)
                                        ->sum('amount');

      $balance = $deposit - $withdrawal;

      return view('finance.balance', compact('balance', 'deposit', 'withdrawal'));

    }

    public function viewTransaction($type, $id) {

      if($type == 'Deposit') {
        $t = Deposit::findOrFail($id);
        return view('finance.view-transaction', compact('t', 'type'));
      } else {
        $t = Withdrawal::findOrFail($id);
        return view('finance.view-transaction', compact('t', 'type'));
      }

    }

}
