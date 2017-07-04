<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Plan;
use Auth;

use App\AdminSetting;
use App\User;

use Image;
use Illuminate\Http\Request;

class DepositController extends Controller {

    public function create() {
        $plans = Plan::all();
        $setting = AdminSetting::first();
        return view('finance.deposit', compact('plans', 'setting'));
    }


    public function store(Request $request, $id)  {

        $or_user = User::findOrFail($id);
        $user = Auth::user();

        if($user->id !== $or_user->id) {
          return redirect()->route('dashboard')->withWarning('One more bad attempt and your account will be blocked, thanks :)');
        }

        $this->validate($request, [
          'amount' => 'required|numeric',
          'payment_method' => 'required',
          'email' => 'required|email',
          'transaction_id' => 'required',
          'screenshot' => 'file|image',
          'remark' => 'nullable|min:10'
        ]);

        if ($request->hasFile('screenshot')) {
          $image = $request->file('screenshot');
          $deposit_screenshot = time(). '~~.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(600, 400)->save( public_path('/images/screenshots/'. $deposit_screenshot ));
        }

        Auth::user()->deposits()->create([
          'amount' => $request->amount,
          'transaction_id' => $request->transaction_id,
          'payment_method' => $request->payment_method,
          'email' => $request->email,
          'screenshot' => $deposit_screenshot,
          'remark' => $request->remark
        ]);

        return redirect()->route('deposit.new')->withSuccess('Your deposit request submitted successfully. Check history page for request status');
    }

      public function approve($id) {
        $deposit = Deposit::findOrFail($id);
        $deposit->update([
          'status' => true,
        ]);
        return redirect()->route('pending.deposits')->withSuccess('Deposit request approved and fund added into user account.');
      }

      public function delete($id) {
        $d = Deposit::findOrFail($id);
        $d->delete();

        return redirect()->route('pending.deposits')->withInfo('This spammy request has been deleted!');
      }

      public function addDeposit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.add-deposit', compact('user'));
      }

      public function saveDeposit(Request $request, $id) {
        $user = User::findOrFail($id);

        $user->deposits()->create([
          'transaction_id' => $request->transaction_id,
          'amount' => $request->amount,
          'payment_method' => $request->payment_method,
          'email' => $request->email,
          'status' => true,
          'screenshot' => 'no_image.png',
        ]);

        return redirect()->route('users.all')->withInfo('Deposit added into users account.');

      }

}
