<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Plan;
use App\Faq;
use App\Support;
use Auth;
use App\Deposit;
use App\Withdrawal;
use App\AdminSetting;

use Mail;
use App\Mail\SendUserEmail;

class AdminController extends Controller
{
    public function index() {
      $admin = Auth::user();
      return view('admin.index', compact('admin'));
    }

    public function allPlans() {
      $plans = Plan::all();
      return view('admin.plans.index', compact('plans'));
    }

    public function allFaqs() {
      $faqs = Faq::all();
      return view('faq.manage', compact('faqs'));
    }

    public function allQueries() {
      $queries = Support::where('replied', false)->get();
      return view('admin.support.index', compact('queries'));
    }

    public function setting() {
      $setting = AdminSetting::first();
      return view('admin.setting', compact('setting'));
    }

    public function saveSetting(Request $request) {

      $setting = AdminSetting::create([
        'paypal_email' => $request->paypal_email,
        'skrill_email' => $request->skrill_email,
        'neteller_email' => $request->neteller_email,
        'bitcoin_address' => $request->bitcoin_address
      ]);

      return redirect()->route('admin.setting')->withSuccess('Payment details added into the site.');
    }

    public function updateSetting(Request $request, $id) {
      $setting = AdminSetting::findOrFail($id);

      $setting->update([
        'paypal_email' => $request->paypal_email,
        'skrill_email' => $request->skrill_email,
        'neteller_email' => $request->neteller_email,
        'bitcoin_address' => $request->bitcoin_address
      ]);

      return redirect()->route('admin.setting')->withInfo('payment emails updated!');
    }

    public function getPendingDeposits() {
      $deposits = Deposit::where('status', false)->get();
      return view('admin.deposit.pending-deposits', compact('deposits'));
    }

    public function getPendingWithdrawals() {
      $withdrawals = Withdrawal::where('status', false)->get();
      return view('admin.withdrawal.pending-withdrawals', compact('withdrawals'));
    }

    public function emailForm() {
      $users = User::all();
      return view('admin.mail.email-form', compact('users'));
    }

    public function sendEmail(Request $request) {
      $user = User::findOrFail($request->user_id);
      $message = $request->message;

      Mail::to($user)->send(new SendUserEmail($user, $message));

      return redirect()->back()->withInfo('Your email successfully sent.');
    }
}
