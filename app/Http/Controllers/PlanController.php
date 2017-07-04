<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

use Carbon\Carbon;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('status', true)->get();
        return view('plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'plan_name' => 'required|min:6',
          'plan_info' => 'required',
          'plan_duration' => 'required|numeric',
          'daily_profit' => 'required|numeric',
          'starting_amount' => 'required|numeric',
          'ending_amount' => 'required|numeric',
        ]);

        $plan = Plan::create([
          'plan_name' => $request->plan_name,
          'plan_info' => $request->plan_info,
          'plan_duration' => $request->plan_duration,
          'daily_profit' => $request->daily_profit,
          'starting_amount' => $request->starting_amount,
          'ending_amount' => $request->ending_amount,
          'status' => true,
        ]);

        return redirect()->route('plans.all')->withSuccess('Your plan successfully added.');
    }


    public function getProfitForm() {
      $plans = Plan::where('status', true)->get();
      return view('plans.profit-form', compact('plans'));
    }

    public function getProfitResult(Request $request) {

      $this->validate($request, [
        'plan' => 'required',
        'starting_date' => 'required|date',
        'ending_date' => 'required|date',
        'amount' => 'required|numeric',
      ]);

      $plan = Plan::findOrFail($request->plan);
      $amount = $request->amount;
      $start_date = $request->starting_date;
      $end_date = $request->ending_date;

      $s_date = Carbon::parse($start_date);
      $e_date = Carbon::parse($end_date);

      $duration = $s_date->diffInDays($e_date);

      $daily_profit = $amount * ($plan->daily_profit / 100);

      $profit = $duration * $daily_profit;

      return view('plans.profit-result', compact('plan', 'duration', 'profit', 'amount', 'start_date', 'end_date'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'plan_name' => 'required|min:6',
        'plan_info' => 'required',
        'plan_duration' => 'required|numeric',
        'daily_profit' => 'required|numeric',
        'starting_amount' => 'required|numeric',
        'ending_amount' => 'required|numeric',
      ]);

      $plan = Plan::findOrFail($id);

      $plan->update([
        'plan_name' => $request->plan_name,
        'plan_info' => $request->plan_info,
        'plan_duration' => $request->plan_duration,
        'daily_profit' => $request->daily_profit,
        'starting_amount' => $request->starting_amount,
        'ending_amount' => $request->ending_amount,
        'status' => true,
      ]);

      return redirect()->route('plans.all')->withSuccess('Plan updated with your new information successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('plans.all')->withSuccess('Plan deleted from website successfully.');
    }

    public function hide($id) {
      $plan = Plan::findOrFail($id);
      $plan->status = false;
      $plan->save();

      return redirect()->route('plans.all')->withSuccess('Plan marked as hidden.');
    }

    public function unHide($id) {
      $plan = Plan::findOrFail($id);
      $plan->status = true;
      $plan->save();

      return redirect()->route('plans.all')->withSuccess('Plan marked as visible.');
    }
}
