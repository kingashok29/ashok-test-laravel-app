@extends('layouts.app')
@section('title', 'Browse our investment plans')
@section('content')

  <h1>Our plans</h1>
  <p>Have a look at our plans, choose your plan and invest.</p>

  @if($plans->count())

    <a role="button" href="{{ route('profit.form') }}" class="btn btn-md btn-primary"><i class="fa fa-dollar"></i> Calculate profit</a>
    <hr>

    <div class="plan-container">
      @foreach($plans as $p)
        <div class="single-plan">
          <h3>{{ $p->plan_name }}</h3>
          <p>{{ $p->plan_info }}</p>
          <p><b>Plan Duration - </b> {{ $p->plan_duration }} Days</p>
            <div class="plan__info">
              <ul>
                <li>Min Investment - ${{ $p->starting_amount }}</li>
                <li>Max Investment - ${{ $p->ending_amount }}</li>
                <li>Daily profit - {{ $p->daily_profit }}%</li>
              </ul>
            </div>
            <a href="{{ route('deposit.new') }}" role="button" class="btn btn-block btn-info">Select this plan</a>
        </div>
      @endforeach
    </div>

  @else
    <div class="well no-plan">
      <h3>No plans found!</h3>
      <p> Soon we will release new plans. </p>
    </div>
  @endif

@endsection
