@extends('layouts.app')
@section('title', 'Calculate your profits')
@section('content')

  <h1>Your profit results.</h1>
  <p>
    Here is complete breakdown of your profits.
  </p>

  <div class="well well-lg profit-result">
    <h5>
      If you deposit <b>${{ $amount }}</b> in plan - <b>{{ $plan->plan_name }}</b>, for <b>{{ $duration }} days</b> from
      <b>{{ $start_date }}</b> to <b>{{ $end_date }}</b>, your total profit as per plan <b>{{ $plan->daily_profit }}% Daily</b>
      will be <b>${{ $profit }}</b>. At the end of your plan you will receive total
       <b>${{ $amount }} + ${{ $profit }} = ${{ $amount + $profit }}</b> back. <br>
       Thanks for using, we hope you will invest with us. Have a great day ahead :)
    </h5>
    <div class="button text-center">
      <a href="{{ route('deposit.new') }}" role="button" class="btn btn-md btn-info"> Yes! I want to invest </a>
      <a href="{{ route('dashboard') }}" role="button" class="btn btn-md btn-danger"> No! Go home </a> <br>
    </div>
  </div>

@endsection
