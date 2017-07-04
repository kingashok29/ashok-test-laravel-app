@extends('layouts.app')
@section('title', 'Edit plan')
@section('content')

  <h1>Edit plan</h1>
  <p>You are editing plan with title - <b><u> {{ $plan->plan_name }} </u></b></p>

  @if(Session::has('errors'))
    <div class="alert alert-danger form-errors">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form-horizontal" action="{{ route('plan.update', $plan->id) }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-md-4">
        <label for="plan_name">Plan name:</label>
        <input type="text" name="plan_name" class="form-control" value="{{ $plan->plan_name }}">
      </div>
      <div class="col-md-4">
        <label for="plan_duration">Plan duration:</label>
        <input type="number" name="plan_duration" class="form-control" value="{{ $plan->plan_duration }}">
      </div>
      <div class="col-md-4">
        <label for="plan_profit">Daily profit (%):</label>
        <input type="number" name="daily_profit" class="form-control" value="{{ $plan->daily_profit }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label for="plan_info">Plan information:</label>
        <textarea name="plan_info" rows="4" class="form-control">{{ $plan->plan_info }}</textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-6">
        <label for="starting_amount">Starting amount:</label>
        <input type="number" name="starting_amount" class="form-control" value="{{ $plan->starting_amount }}">
      </div>
      <div class="col-md-6">
        <label for="ending_amount">Ending amount:</label>
        <input type="number" name="ending_amount" class="form-control" value="{{ $plan->ending_amount }}">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-upload"></i> Update investment plan </button>
        <a href="{{ route('plans.all') }}" class="btn btn-md btn-danger" role="button"> Cancel &amp; view plans</a>
      </div>
    </div>

  </form>

@endsection
