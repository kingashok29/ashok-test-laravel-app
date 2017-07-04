<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Plan;
use App\UserPlan;
use Auth;

use App\AdminSetting;
use App\User;

use Image;
use Illuminate\Http\Request;

class DepositController extends Controller {

    /**
     * Send all plans on deposit form.
     */

    public function create() {
        //Here AdminSetting model will return the email address of site payment methods.
        $plans = Plan::all();
        $setting = AdminSetting::first();
        return view('finance.deposit', compact('plans', 'setting'));
    }


    public function store(Request $request, $id)  {

        $or_user = User::findOrFail($id);

        if (Auth::user()->id !== $or_user->id) {
          return redirect()->route('dashboard')->withWarning('One more bad attempt and your account will be blocked, thanks :)');
        }

        $this->validate($request, [
          'amount' => 'required|numeric',
          'payment_method' => 'required',
          'email' => 'required|email',
          'transaction_id' => 'required',
          'screenshot' => 'file|image',
          'remark' => 'nullable|min:10',
          'plan_id' => 'required',
        ]);

        if ($request->hasFile('screenshot')) {
          $image = $request->file('screenshot');
          $deposit_screenshot = time(). '~~.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(600, 400)->save( public_path('/images/screenshots/'. $deposit_screenshot ));
        }

        Auth::user()->deposits()->create([
          'amount' => $request->amount,
          'plan_id' => $request->plan_id,
          'transaction_id' => $request->transaction_id,
          'payment_method' => $request->payment_method,
          'email' => $request->email,
          'screenshot' => $deposit_screenshot,
          'remark' => $request->remark
        ]);

        //Inserting record in user plan pivot table.
        Auth::user()->plans()
                    ->attach($request->plan_id, array('amount' => $request->amount, 'status' => 'pending'));

        //Redirecting user to transaction history page.
        return redirect()->route('history.all')
                         ->withSuccess('Your deposit request submitted successfully. Check history page for request status');
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
          'plan_id' => $request->plan_id,
          'amount' => $request->amount,
          'payment_method' => $request->payment_method,
          'email' => $request->email,
          'status' => true,
          'screenshot' => 'no_image.png',
        ]);

        return redirect()->route('users.all')->withInfo('Deposit added into users account.');

      }

}
